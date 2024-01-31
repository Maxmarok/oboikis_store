<x-mail::message>
# Оформлен заказ #{{$order->id}}

Имя: {{$order->name}}  
Email: {{$order->user->email}}  
Телефон: {{$order->phone}}  
Комментарий: {{$order->comment}}  
Получение: {{$order->recieve}}  

Данные о заказе:  
@foreach($order->order_items as $i => $item)
{{$i + 1}}. [{{$item->item->title}}]({{route('catalog_item', ['section' => $item->item->catalog->url, 'id' => $item->item->id])}}) {{$item->quantity}} шт. x {{number_format($item->total, 0, '', ' ')}} ₽
@endforeach

Итого к оплате: {{number_format($order->order_sum, 0, '', ' ')}} ₽  

<x-mail::button :url="$url">
Перейти к заказам
</x-mail::button>

С уважением,<br>
{{ config('app.name') }}
</x-mail::message>
