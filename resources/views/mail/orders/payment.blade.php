<x-mail::message>
# Здравствуйте, {{$order->name}}!

Заказ #{{$order->orderNumber ?: $order->id}} подтвержден!  

Итого к оплате: {{number_format($order->order_sum, 0, '', ' ')}} ₽  

<x-mail::button :url="$url">
Оплатить заказ
</x-mail::button>

С уважением,<br>
{{ config('app.name') }}
</x-mail::message>
