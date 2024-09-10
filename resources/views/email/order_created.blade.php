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

    
    <h4>Уведомление о заказе для рассмотрения вашей инстанцией - {{ $details['instance_ru'] }}</h4>

    <p><b>Id заказа:</b> {{ $details['order_id'] }}</p>

    <p><b>Сайт:</b> {{ $details['url'] }}</p>

    @if ($details['copy_to_email'])
        <p><b>Срок рассмотрения:</b> {{ $details['working_hour'] }} рабочих часов</p>
    @endif

    <p><b>Адрес заказчика:</b> {{ $details['customer_email'] }}</p>

    ________________________________________________

   
    <h4>Notification of order for consideration by your instance - {{ $details['instance_en'] }}</h4>

    <p><b>Order id:</b> {{ $details['order_id'] }}</p>

    <p><b>Site:</b> {{ $details['url'] }}</p>

    @if ($details['copy_to_email'])
        <p><b>Period of consideration:</b> {{ $details['working_hour'] }} working hours</p>
    @endif

    <p><b>Customer address:</b> {{ $details['customer_email'] }}</p>


</body>
</html>
