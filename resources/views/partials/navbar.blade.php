@php
    $home = route('home');

    // Satu daftar menu dipakai untuk navbar atas (laptop) dan bottom nav (HP/tablet)
    $items = [
        [
            'label' => 'Beranda',
            'short' => 'Beranda',
            'href' => $home . '#home',
            'spy' => 'home',
            'active' => request()->routeIs('home'),
            'icon' => '<path d="M3 11l9-8 9 8"/><path d="M5 10v10h14V10"/><path d="M10 20v-6h4v6"/>',
        ],
        [
            'label' => 'Tentang BD',
            'short' => 'Tentang',
            'href' => $home . '#about',
            'spy' => 'about',
            'active' => false,
            'icon' => '<circle cx="12" cy="12" r="9"/><path d="M12 11v5M12 8h.01"/>',
        ],
        [
            'label' => 'Produk',
            'short' => 'Produk',
            'href' => $home . '#products',
            'spy' => 'products',
            'active' => request()->routeIs('products.*'),
            'icon' => '<path d="M5 8h14l-1 12H6L5 8z"/><path d="M9 8a3 3 0 016 0"/>',
        ],
        [
            'label' => 'Kolaborasi',
            'short' => 'Kolaborasi',
            'href' => $home . '#collaborations',
            'spy' => 'collaborations',
            'active' => request()->is('kolaborasi*'),
            'icon' =>
                '<circle cx="9" cy="8" r="3"/><path d="M3 20c0-3.3 2.7-6 6-6s6 2.7 6 6"/><circle cx="17" cy="9" r="2.5"/><path d="M17 14c2.5 0 4 1.8 4 4"/>',
        ],
        [
            'label' => 'Kontak',
            'short' => 'Kontak',
            'href' => $home . '#contact',
            'spy' => 'contact',
            'active' => false,
            'icon' => '<rect x="3" y="5" width="18" height="14" rx="2"/><path d="M3 7l9 6 9-6"/>',
        ],
    ];
@endphp

<header>

    <div class="wrap nav">

        {{-- LOGO --}}
        <a href="{{ route('home') }}" class="logo" aria-label="BD — Business Development">
            <span class="logo-chip">
                <img src="{{ asset('images/logobd.png') }}" alt="BD"
                    onerror="this.replaceWith(document.createTextNode('BD'))">
            </span>

            <span class="logo-text">
                <strong>Business Development</strong>
            </span>
        </a>


        {{-- NAVIGATION (laptop) --}}
        <nav class="links" id="links" aria-label="Menu utama">
            @foreach ($items as $item)
                <a href="{{ $item['href'] }}" data-spy="{{ $item['spy'] }}" class="{{ $item['active'] ? 'on' : '' }}">
                    {{ $item['label'] }}
                </a>
            @endforeach
        </nav>


        <span class="sp"></span>


        {{-- SEARCH (laptop) --}}
        <form class="search" action="{{ route('products.index') }}">
            <x-i n="search" />

            <input name="q" value="{{ request('q') }}"
                placeholder="Cari produk, kategori, atau nama mahasiswa...">
        </form>

        {{-- SEARCH (HP/tablet) --}}
        <a href="{{ route('products.index') }}" class="ic b search-ic" aria-label="Cari produk">
            <x-i n="search" />
        </a>


        {{-- THEME --}}
        <button class="ic" id="theme" aria-label="Ganti tema">
            <x-i n="sun" />
        </button>


        {{-- AKUN --}}
        @auth
            <div class="acct">

                <button type="button" class="acct-btn" id="acctBtn" aria-haspopup="menu" aria-expanded="false"
                    aria-controls="acctMenu">
                    <span
                        class="acct-av">{{ \Illuminate\Support\Str::upper(\Illuminate\Support\Str::substr(auth()->user()->name, 0, 1)) }}</span>
                    <span class="acct-name">{{ \Illuminate\Support\Str::before(auth()->user()->name, ' ') }}</span>
                    <svg class="i chev" viewBox="0 0 24 24">
                        <path d="M6 9l6 6 6-6" />
                    </svg>
                </button>

                <div class="acct-menu" id="acctMenu" role="menu" hidden>

                    <div class="acct-head">
                        <b>{{ auth()->user()->name }}</b>
                        <small>{{ auth()->user()->email }}</small>
                    </div>

                    <a href="{{ route('dashboard') }}" role="menuitem">
                        <svg class="i" viewBox="0 0 24 24">
                            <rect x="3" y="3" width="7" height="7" rx="1.5" />
                            <rect x="14" y="3" width="7" height="7" rx="1.5" />
                            <rect x="3" y="14" width="7" height="7" rx="1.5" />
                            <rect x="14" y="14" width="7" height="7" rx="1.5" />
                        </svg>
                        Dashboard
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button type="submit" class="out" role="menuitem">
                            <svg class="i" viewBox="0 0 24 24">
                                <path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4M16 17l5-5-5-5M21 12H9" />
                            </svg>
                            Keluar
                        </button>
                    </form>

                </div>
            </div>
        @else
            <a href="{{ route('login') }}" class="btn p nav-login">
                Masuk
            </a>
        @endauth

    </div>

</header>


{{-- BOTTOM NAV (HP & tablet) --}}
<nav class="bnav" aria-label="Menu bawah">
    @foreach ($items as $item)
        <a href="{{ $item['href'] }}" data-spy="{{ $item['spy'] }}" class="{{ $item['active'] ? 'on' : '' }}">
            <svg class="i" viewBox="0 0 24 24">{!! $item['icon'] !!}</svg>
            <span>{{ $item['short'] }}</span>
        </a>
    @endforeach
</nav>


@push('scripts')
    <script>
        (() => {
            /* ---------- Dropdown akun ---------- */
            const btn = document.getElementById('acctBtn');
            const menu = document.getElementById('acctMenu');

            if (btn && menu) {
                const close = () => {
                    menu.hidden = true;
                    btn.setAttribute('aria-expanded', 'false');
                };

                btn.addEventListener('click', e => {
                    e.stopPropagation();
                    const willOpen = menu.hidden;
                    menu.hidden = !willOpen;
                    btn.setAttribute('aria-expanded', String(willOpen));
                });

                document.addEventListener('click', e => {
                    if (!menu.contains(e.target)) close();
                });

                document.addEventListener('keydown', e => {
                    if (e.key === 'Escape') close();
                });
            }

            /* ---------- Menu aktif mengikuti scroll (di halaman Beranda) ---------- */
            const links = [...document.querySelectorAll('[data-spy]')];
            const sections = [...new Set(links.map(a => a.dataset.spy))]
                .map(id => document.getElementById(id))
                .filter(Boolean);

            if (sections.length && 'IntersectionObserver' in window) {
                const setActive = id => links.forEach(a => a.classList.toggle('on', a.dataset.spy === id));

                const io = new IntersectionObserver(entries => {
                    entries.forEach(en => {
                        if (en.isIntersecting) setActive(en.target.id);
                    });
                }, {
                    rootMargin: '-45% 0px -50% 0px'
                });

                sections.forEach(s => io.observe(s));
            }
        })();
    </script>
@endpush
