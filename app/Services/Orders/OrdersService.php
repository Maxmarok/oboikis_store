<?php

namespace App\Services\Orders;

use App\Enums\StatusEnum;
use App\Events\OrderChangedEvent;
use App\Events\PaymentSuccess;
use App\Events\TestEvent;
use App\Jobs\PaymentSuccessJob;
use App\Mail\SendPaymentMail;
use App\Mail\SendPaymentSuccessMail;
use App\Models\Items;
use App\Models\Managers;
use App\Models\OrderItems;
use App\Models\Orders;
use App\Models\User;
use App\Services\Sbis\SbisInterface as Sbis;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;

class OrdersService implements OrdersInterface
{
    public function __construct(
        private Sbis $sbis
    ){}

    public function getOrders(): JsonResponse
    {
        $orders = Orders::with(['order_items', 'user'])
            //->orderByRaw("FIELD(status, {$statuses['canceled']}',1,3,2)")
            ->orderBy('status', 'asc')
            ->orderBy('id', 'desc')
            ->paginate(20);

        return response()->json([
            'success' => true,
            'data' => $orders,
        ]); 
    }

    public function checkOrder(string $id): JsonResponse
    {
        $sbisOrder = $this->sbis->checkOrder($id);
        $order = Orders::where('salekey', $id)->first();
        $data = [];
        $items = $order->order_items;
        
        $numbers = array_column($sbisOrder['nomenclatures'], 'nomNumber');
        $items = Items::whereIn('nomNumber', $numbers)->get()->pluck('id', 'nomNumber');

        foreach($sbisOrder['nomenclatures'] as $item) {
            $data[] = [
                'price' => $item['cost'],
                'count' => $item['count'],
                'item_id' => $items[$item['nomNumber']],
                'order_id' => $order->id,
            ];
        }

        $order->order_items()->delete();
        $order->order_items()->insert($data);

        $link = $this->sbis->getPaymentLink($id);
        $order->paymentRef = $link;
        $order->save();

        $order = Orders::where('salekey', $id)->with(['order_items', 'user'])->first();
        
        return response()->json([
            'success' => true,
            'data' => $order,
        ]); 
    }

    public function checkPayment(string $id): JsonResponse
    {
        $payment = $this->sbis->checkPayment($id);
        $order = Orders::where('salekey', $id)->first();

        if(count($payment['payments']) > 0) {
            if($order->status === StatusEnum::WAITING) {
                $order->status = StatusEnum::PAYED;
                $order->save();
            }
        }
        
        return response()->json([
            'success' => true,
            'data' => $order,
        ]); 
    }

    public function confirmOrder(string $id): JsonResponse
    {
        $order = Orders::find($id);
        $order->status = StatusEnum::WAITING;
        $order->save();

        Mail::to($order->user)->send(new SendPaymentMail($order));

        return response()->json([
            'success' => true,
            'data' => $order,
        ]); 
    }

    public function cancelOrder(string $id): JsonResponse
    {
        $order = Orders::find($id);
        $order->status = StatusEnum::CANCELED;
        $order->save();

        //Mail::to($order->user)->send(new SendPaymentMail($order));

        return response()->json([
            'success' => true,
            'data' => $order,
        ]); 
    }

    public function completeOrder(string $id): JsonResponse
    {
        $order = Orders::find($id);
        $order->status = StatusEnum::CLOSED;
        $order->save();

        return response()->json([
            'success' => true,
            'data' => $order,
        ]); 
    }

    public function returnOrder(string $id): JsonResponse
    {
        $order = Orders::find($id);
        $order->status = StatusEnum::REGISTERED;
        $order->save();

        return response()->json([
            'success' => true,
            'data' => $order,
        ]); 
    }

    public function sendPaymentLink(string $id): JsonResponse
    {
        $order = Orders::find($id);

        Mail::to($order->user)->send(new SendPaymentMail($order));

        return response()->json([
            'success' => true,
        ]);
    }
    
    public function successPayment(string $id): RedirectResponse
    {
        $order = Orders::whereRaw('md5(id) = "' . $id . '"')->first();

        if($order->status === StatusEnum::WAITING) {
            $order->status = StatusEnum::PAYED;
            $order->save();

            PaymentSuccessJob::dispatchAfterResponse($order);
        }

        return redirect()->route('order', ['payment' => 'success']);
    }

    private function changeStatus($id, $status): Orders
    {
        $order = Orders::find($id);
        $order->status = $status;
        $order->save();

        return $order;
    }
}
