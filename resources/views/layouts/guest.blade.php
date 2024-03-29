<!DOCTYPE html>
<html lang="en">

<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>@yield('title')</title>
    <meta name="theme-color" content="#ffffff">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <!-- Custom Style -->
    @yield('importcss')
</head>

<body>


    <div class="container">
        <div class="row justify-content-center">
            @yield('content')
        </div>
    </div>


</body>

</html>
