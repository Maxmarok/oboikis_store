<x-mail::message>
# Здравствуйте, {{$order->name}}!

Вы оформили заказ #{{$order->id}}:  
@foreach($order->order_items as $i => $item)
{{$i + 1}}. [{{$item->item->title}}]({{route('catalog_item', ['section' => $item->item->catalog->url, 'id' => $item->item->id])}}) {{$item->count}} шт. x {{number_format($item->total, 0, '', ' ')}} ₽
@endforeach

Итого к оплате: {{number_format($order->order_sum, 0, '', ' ')}} ₽  {{$order->isPickup() ? '(без учета доставки)' : null}}  

Доставка: {{$order->recieve}}  

Наш менеджер свяжется с Вами в течение нескольких минут в рабочее время с 10:00 до 20:00 часов по московскому времени для подтверждения заказа

<!-- <x-mail::button :url="''">
Button Text
</x-mail::button> -->

С уважением,<br>
{{ config('app.name') }}
</x-mail::message>
