<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>User Admin | Time Report</title>
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('resources/images/main.png') }}">
        <link rel="icon" type="image/png" href="{{ asset('resources/images/main.png') }}" sizes="32x32">
        <link rel="icon" type="image/png" href="{{ asset('resources/images/main.png') }}" sizes="16x16">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

        @stack('pre-css')
        <link rel="stylesheet" href="{{ asset('vendor/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('vendor/bootstrap-3.3.7/dist/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('vendor/font-awesome/css/font-awesome.min.css') }}">
        {{-- <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"> --}}
        <link rel="stylesheet" href="{{ asset('vendor/css/ionicons.min.css') }}">
        <link rel="stylesheet" href="{{ asset('vendor/css/fullcalendar.min.css') }}">
        <script src="{{ asset('vendor/js/raphael-min.js') }}"></script>
        <script src="{{ asset('vendor/js/jquery-1.8.2.min.js') }}"></script>
        <script src="{{ asset('vendor/js/morris-0.4.1.min.js') }}"></script>

        <!-- template theme -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <link rel="stylesheet" href="{{ asset('vendor/admin-lte/plugins/iCheck/all.css') }}">
        <link rel="stylesheet" href="{{ asset('vendor/admin-lte/plugins/colorpicker/bootstrap-colorpicker.min.css') }}">
        <link rel="stylesheet" href="{{ asset('vendor/admin-lte/plugins/timepicker/bootstrap-timepicker.min.css') }}">
        <link rel="stylesheet" href="{{ asset('vendor/admin-lte/plugins/select2/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('vendor/admin-lte/dist/css/AdminLTE.min.css') }}">
        <link rel="stylesheet" href="{{ asset('vendor/admin-lte/dist/css/skins/_all-skins.min.css') }}">

        <!-- employee lists (table) -->
        <link rel="stylesheet" href="{{ asset('vendor/css/dataTables.bootstrap.min.css') }}">
        <!--  export buttons -->
        <link rel="stylesheet" href="{{ asset('vendor/css/buttons.dataTables.min.css') }}">
        @stack('css')
    </head>
    <body class="hold-transition skin-blue sidebar-mini">