<x-mail::message>
# Здравствуйте, {{$order->name}}!

Заказ #{{$order->orderNumber ?: $order->id}} оплачен!  

Обои будут доставлены в салон до 10 дней.  

Благодарим Вас за выбор ОбойКис.  

При возникновении вопросов, на сайте есть социальные сети и номер телефона.  

С уважением,<br>
{{ config('app.name') }}
</x-mail::message>
