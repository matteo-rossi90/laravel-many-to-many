<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Boolfolio | Admin</title>

    {{-- CDN fontawesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

     <!-- Usando Vite -->
    @vite(['resources/js/app.js'])
</head>
<body>

    @include('admin.partials.header')
    <div class="d-flex justify-content-center wrapper">

        @auth
            @include('admin.partials.aside')
        @endauth
        <div class="content">
            @yield('content')
        </div>

    </div>
    <script type="text/javascript" src="{{Vite::asset('resources/js/functions.js') }}"></script>
</body>
</html>
