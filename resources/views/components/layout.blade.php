<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <title>Sistem Pakar Thalassemia</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    @vite('resources/css/app.css')
</head>


<body class="bg-cream min-h-screen flex flex-col">
    @isset($login)
    @else
        @include('components.navbar', ['noButton' => $noButton ?? false])
    @endisset
    @yield('content')
    @isset($login)
    @else
        @include('components.footer')
    @endisset

    @stack('scripts')
</body>

</html>
