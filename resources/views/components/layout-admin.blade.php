<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <title>Admin</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    @vite('resources/css/app.css')
</head>

<body class="bg-cream">
    @include('components.navbar-admin')
    @if (session('success'))
        <div class="container py-8">
            <div class="bg-green-100 p-3 rounded-md col-span-12 mb-5 text-green-800">{{ session('success') }}</div>
        </div>
    @endif
    @yield('content')
    @include('components.footer')

    @stack("scripts")
</body>

</html>
