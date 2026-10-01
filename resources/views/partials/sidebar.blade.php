<aside class="dash-side">
    <a href="{{ route('home') }}" class="dash-logo">
        <img src="{{ asset('images/logobd.png') }}" alt="Logo BD" class="pgb-logo">
        <span><strong>BD</strong><small>Business Development</small></span>
    </a>

    <nav class="dash-nav">
        <p class="dash-label">Menu Utama</p>
        <a href="{{ route('dashboard') }}" class="dash-link {{ request()->routeIs('dashboard') ? 'on' : '' }}"><x-i
                n="grid" /> Dashboard</a>
        <a href="{{ route('reseller.products') }}"
            class="dash-link {{ request()->routeIs('reseller.products') ? 'on' : '' }}"><x-i n="bag" /> Produk Saya</a>
        <a href="{{ route('reseller.products.create') }}"
            class="dash-link {{ request()->routeIs('reseller.products.create') ? 'on' : '' }}"><x-i n="plus" /> Tambah
            Produk</a>

        <p class="dash-label mt">Akun</p>
        <a href="{{ route('reseller.profile') }}"
            class="dash-link {{ request()->routeIs('reseller.profile') ? 'on' : '' }}"><x-i n="user" /> Profil Saya</a>
    </nav>

    <div class="dash-side-foot">
        <a href="{{ route('home') }}" class="dash-link"><x-i n="home" /> Kembali ke Website</a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="dash-link out"><x-i n="logout" /> Keluar</button>
        </form>
    </div>
</aside>
