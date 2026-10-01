<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">

    <title>
        @yield('title', 'BD – Business Development Student Marketplace')
    </title>

    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Playfair+Display:ital,wght@1,600;1,700&family=Dancing+Script:wght@600;700&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    @stack('styles')

</head>

<body>

    @include('partials.icons')

    @include('partials.navbar')

    <main>
        @yield('content')
    </main>

    @include('partials.footer')


    {{-- =========================================================
         CHATBOT B-DI
    ========================================================== --}}
    <a href="{{ route('chatbot.page') }}" class="fab" aria-label="Chat B-Di">
        <x-i n="chat" />
    </a>



    <script src="{{ asset('js/app.js') }}"></script>
    @stack('scripts')

</body>

</html>
