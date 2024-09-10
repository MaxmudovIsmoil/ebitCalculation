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

    <h4>CRM admin</h4>

    <p>Url: {{ $details['url'] }}</p>

    <p>Username: <code>{{ $details['username'] }}</code></p>

    <p>Password: <code>{{ $details['password'] }}</code></p>

</body>
</html>
