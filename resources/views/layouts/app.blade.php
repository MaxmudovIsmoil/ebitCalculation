<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" id="js_meta" content="{{ csrf_token() }}">
    <title>{{ config('app.name') }}</title>

    <link rel="manifest" href="{{ asset('assets/site.manifest') }}">
    <!-- Bootstrap CSS -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('assets/datepicker/gijgo.min.css') }}">

    <!-- Datatables CSS -->
    <link rel="stylesheet" href="{{ asset('assets/datatable/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/datepicker/gijgo.min.css') }}">
    <!-- Fontawesome CSS -->

    <link rel="stylesheet" href="{{ asset('assets/fontawesome/css/all.min.css') }}">
    <!-- Select2 CSS -->
    <link rel="stylesheet" href="{{ asset('assets/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/jquery-ui/jQueryUi.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fancybox3.5/fancybox.min.css') }}">
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}" />

    @stack('style')
</head>
<body>
    @include('layouts.header')

    @yield('content')

{{--    @include('layouts.employeeModal')--}}

    <!-- jQuery -->
    <script src="{{ asset('assets/js/jquery3.7.js') }}"></script>
    <!-- Bootstrap JS -->
    <script src="{{ asset('assets/popper/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/datepicker/gijgo.min.js') }}"></script>
    <!-- Datatables JS -->
    <script src="{{ asset('assets/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/datatable/dataTables.bootstrap5.min.js') }}"></script>

    <!-- Select2 -->
    <script src="{{ asset('assets/select2/select2.min.js') }}"></script>
    <script src="{{ asset('assets/jquery-ui/jQueryUi.min.js') }}"></script>
    <script src="{{ asset('assets/fancybox3.5/fancybox.min.js') }}"></script>
    <!-- Main JS -->
    <script src="{{ asset('assets/js/delete_function.js') }}"></script>
    <script src="{{ asset('assets/js/validation.js') }}"></script>

    @stack('script')
</body>
</html>
