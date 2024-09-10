<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', 'CRM') }}</title>
    <style>
        h4 {
            font-size: 16px;
            margin-top: 15px;
            margin-bottom: 10px;
        }
        p {
            font-size: 14px;
            margin-top: 3px;
            margin-bottom: 3px;
            color: #000;
        }
    </style>
</head>
<body>

    @isset($details['to_instance_ru'])
        <h4>Уведомление о заказе для рассмотрения вашей инстанцией - {{ $details['to_instance_ru'] }}</h4>
    @endisset

    @issent($details['from_instance_ru'])
        <p><b>От:</b> {{ $details['from_instance_ru'] }}</p>
    @endisset

    @isset($details['status'])
        <p><b>Ответ инстанции:</b> @if($details['status'] == 1) Согласовано @else Отказано @endif</p>
    @endisset

    <p><b>Id заказа:</b> {{ $details['order_id'] }}</p>

    <p><b>Сайт:</b> {{ $details['url'] }}</p>

    @if ($details['not_copy_to_email'])
        <p><b>Срок рассмотрения:</b> {{ $details['working_hour'] }} рабочих часов</p>
    @endif

    <p><b>Адрес заказчика:</b> {{ $details['customer_email'] }}</p>

    ________________________________________________

    @isset($details['to_instance_en'])
        <h4>Notification of order for consideration by your instance - {{ $details['to_instance_en'] }}</h4>
    @endisset

    @issent($details['from_instance_en'])
        <p><b>From:</b> {{ $details['from_instance_en'] }}</p>
    @ensisset

    @isset($details['status'])
        <p><b>Decision:</b> @if($details['status'] == 1) Agreed @else Declined @endif</p>
    @endisset

    <p><b>Order id:</b> {{ $details['order_id'] }}</p>


    <p><b>Site:</b> {{ $details['url'] }}</p>


    @if ($details['not_copy_to_email'])
        <p><b>Period of consideration:</b> {{ $details['working_hour'] }} working hours</p>
    @endif

    <p><b>Customer address:</b> {{ $details['customer_email'] }}</p>


</body>
</html>
