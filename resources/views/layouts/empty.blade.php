{{--
Основной шаблон сайта:
- регистрация и авторизация
- справочники
--}}
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Автосалон</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css')}}">
    <!-- overlayScrollbars -->
{{--    <link rel="stylesheet" href="{{ asset('adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">--}}
</head>
<body class="hold-transition sidebar-mini layout-fixed">

@include('includes.alert')

<div class="wrapper d-flex flex-column min-vh-100 bg-gradient-gray">
    {{-- Контент в центре --}}
    <div class="flex-grow-1 d-flex align-items-center justify-content-center">
        @yield('content')
    </div>
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

</body>
</html>
