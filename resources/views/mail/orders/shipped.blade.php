<x-mail::message>
# Здравствуйте, {{$order->name}}!

Вы оформили заказ #{{$order->id}}:  
@foreach($items as $i => $item)
{{$i + 1}}. [{{$item->item->title}}]({{route('catalog_item', ['section' => $item->item->catalog->url, 'id' => $item->item->id])}}) {{$item->quantity}} шт. x {{number_format($item->total, 0, '', ' ')}} ₽
@endforeach

Итого к оплате: {{number_format($items->sum('total'), 0, '', ' ')}} ₽  

Наш менеджер свяжется с Вами в течение нескольких минут в рабочее время с 10:00 до 22:00 часов  

<!-- <x-mail::button :url="''">
Button Text
</x-mail::button> -->

С уважением,<br>
{{ config('app.name') }}
</x-mail::message>
