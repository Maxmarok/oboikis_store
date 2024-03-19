<?php

namespace App\Jobs;

use App\Mail\OrderShippedAdmin;
use App\Mail\OrderShippedUser;
use App\Models\OrderItems;
use App\Models\Orders;
use App\Services\Sbis\SbisInterface as Sbis;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class MakeOrderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $admin;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public Orders $order,
    ){
        $this->admin = env('MAIL_FROM_ADDRESS');
    }

    /**
     * Execute the job.
     */
    public function handle(Sbis $sbis): void
    {
        $sbis->createOrder($this->order);
        Mail::to($this->order->user)->send(new OrderShippedUser($this->order));
        Mail::to($this->admin)->send(new OrderShippedAdmin($this->order));
    }
}
