<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">

    <title>
        @yield('title', 'BD – Business Development')
    </title>

    <link rel="icon" type="image/jpeg" href="{{ asset('images/Logo.png') }}?v=1">
    <link rel="apple-touch-icon" href="{{ asset('images/Logo.jpg') }}?v=1">
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const fab = document.querySelector('.fab');

            if (!fab) return;

            let isDragging = false;
            let startX = 0;
            let startY = 0;
            let startLeft = 0;
            let startTop = 0;
            let moved = false;

            fab.addEventListener('pointerdown', function(e) {
                isDragging = true;
                moved = false;

                const rect = fab.getBoundingClientRect();

                startX = e.clientX;
                startY = e.clientY;
                startLeft = rect.left;
                startTop = rect.top;

                fab.style.left = startLeft + 'px';
                fab.style.top = startTop + 'px';
                fab.style.right = 'auto';
                fab.style.bottom = 'auto';

                fab.setPointerCapture(e.pointerId);
            });

            fab.addEventListener('pointermove', function(e) {
                if (!isDragging) return;

                const dx = e.clientX - startX;
                const dy = e.clientY - startY;

                if (Math.abs(dx) > 5 || Math.abs(dy) > 5) {
                    moved = true;
                }

                let newLeft = startLeft + dx;
                let newTop = startTop + dy;

                const maxLeft = window.innerWidth - fab.offsetWidth;
                const maxTop = window.innerHeight - fab.offsetHeight;

                newLeft = Math.max(0, Math.min(newLeft, maxLeft));
                newTop = Math.max(0, Math.min(newTop, maxTop));

                fab.style.left = newLeft + 'px';
                fab.style.top = newTop + 'px';
            });

            fab.addEventListener('pointerup', function(e) {
                isDragging = false;

                fab.releasePointerCapture(e.pointerId);

                if (moved) {
                    fab.dataset.dragged = 'true';

                    setTimeout(() => {
                        fab.dataset.dragged = 'false';
                    }, 200);
                }
            });

            fab.addEventListener('click', function(e) {
                if (fab.dataset.dragged === 'true') {
                    e.preventDefault();
                }
            });
        });
    </script>

</body>

</html>
