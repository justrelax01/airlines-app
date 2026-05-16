<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', config('app.name', 'Laravel'))</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link rel="stylesheet" href="/css/app.css">
    <link rel="stylesheet" href="/css/external.css">
    <script src="/js/app.js" defer></script>
    <script src="/js/js.js" defer></script>
    @yield('styles')
</head>
<body>
    @include('partials.navigation')
    <main>
        @yield('content')
    </main>
    @yield('scripts')
</body>
</html>