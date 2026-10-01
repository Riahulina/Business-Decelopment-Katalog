<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard – BD')</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    @stack('styles')
</head>

<body>
    @include('partials.icons')
    <div class="dash">
        @include('partials.sidebar')
        <main class="dash-main">
            @yield('content')
        </main>
    </div>
    <div class="toast" id="toast"></div>
    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')
</body>

</html>
