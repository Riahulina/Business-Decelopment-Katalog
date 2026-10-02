@php
    $menu = [
        ['route' => 'dashboard', 'icon' => 'grid', 'label' => 'Dashboard', 'match' => ['dashboard']],
        [
            'route' => 'reseller.products',
            'icon' => 'bag',
            'label' => 'Produk Saya',
            'match' => ['reseller.products', 'reseller.products.show'],
        ],
        [
            'route' => 'reseller.products.create',
            'icon' => 'plus',
            'label' => 'Tambah Produk',
            'match' => ['reseller.products.create'],
        ],
        ['route' => 'reseller.profile', 'icon' => 'user', 'label' => 'Profil Saya', 'match' => ['reseller.profile']],
    ];
@endphp

<aside class="dash-side">
    <a href="{{ route('home') }}" class="dash-logo">
        <img src="{{ asset('images/logobd.png') }}" alt="Logo BD" class="pgb-logo">
        <span><strong>BD</strong><small>Business Development</small></span>
    </a>

    <nav class="dash-nav" aria-label="Menu dashboard">
        <p class="dash-label">Menu Utama</p>

        @foreach ($menu as $item)
            <a href="{{ route($item['route']) }}"
                class="dash-link {{ request()->routeIs(...$item['match']) ? 'on' : '' }}">
                <x-i :n="$item['icon']" /> {{ $item['label'] }}
            </a>
        @endforeach
    </nav>

    <div class="dash-side-foot">
        <a href="{{ route('home') }}" class="dash-link"><x-i n="home" /> Kembali ke Website</a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="dash-link out"><x-i n="logout" /> Keluar</button>
        </form>
    </div>
</aside>
