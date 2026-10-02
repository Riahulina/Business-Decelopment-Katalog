@php
    $menu = [
        ['label' => 'Beranda', 'href' => route('home')],
        ['label' => 'Produk', 'href' => route('products.index')],
        ['label' => 'Tentang BD', 'href' => route('about')],
        ['label' => 'Kolaborasi', 'href' => route('collaborations')],
        ['label' => 'Kontak', 'href' => route('contact')],
    ];

    // Isi href dengan link akun aslinya. Yang null tidak ditampilkan.
    $socials = [
        [
            'icon' => 'cam',
            'label' => 'Instagram',
            'href' => 'https://www.instagram.com/bussinessdevelopmentmi?stkn=M2dud3E5Y2N1eGR1',
        ],
    ];
@endphp

<footer class="site-footer">

    <div class="wrap">

        <div class="ft-grid">

            {{-- ============ BRAND ============ --}}
            <div class="ft-brand">

                <a href="{{ route('home') }}" class="ft-logo" aria-label="BD — Business Development">
                    <span class="ft-logo-img">
                        <img src="{{ asset('images/logobd.png') }}" alt="BD" onerror="this.style.display='none'">
                    </span>

                    <span class="ft-logo-text">
                        <strong>Business Development</strong>
                        <small>Student · Create · Grow</small>
                    </span>
                </a>

                <p>
                    Wadah ide, karya, dan kolaborasi mahasiswa untuk tumbuh menjadi wirausaha muda.
                </p>

                <div class="ft-soc">
                    @foreach ($socials as $s)
                        @if ($s['href'])
                            <a href="{{ $s['href'] }}" aria-label="{{ $s['label'] }}"
                                @if (str_starts_with($s['href'], 'http')) target="_blank" rel="noopener" @endif>
                                <x-i :n="$s['icon']" />
                            </a>
                        @endif
                    @endforeach
                </div>

            </div>


            {{-- ============ MENU ============ --}}
            <nav class="ft-col" aria-label="Menu footer">
                <h4>Menu</h4>

                <ul>
                    @foreach ($menu as $m)
                        <li><a href="{{ $m['href'] }}">{{ $m['label'] }}</a></li>
                    @endforeach
                </ul>
            </nav>


            {{-- ============ HUBUNGI ============ --}}
            <div class="ft-col">
                <h4>Hubungi Kami</h4>

                <ul class="ft-contact">
                    <li>
                        <x-i n="chat" />
                        <a href="https://wa.me/6289508721206?text=Halo%20Admin%20BD%2C%20saya%20ingin%20bertanya%20seputar%20BD."
                            target="_blank" rel="noopener">
                            Chat admin via WhatsApp
                        </a>
                    </li>

                    <li>
                        <x-i n="cam" />
                        <a href="https://www.instagram.com/bussinessdevelopmentmi?stkn=M2dud3E5Y2N1eGR1" target="_blank"
                            rel="noopener">
                            @bd.studentmarketplace
                        </a>
                    </li>

                    <li>
                        <x-i n="pin" />
                        <span>Lantai 1 Gedung N, Kesekretariatan Manajemen Informatika/span>
                    </li>
                </ul>
            </div>

        </div>


        <div class="ft-bottom">
            <span>© {{ date('Y') }} BD. Hak cipta dilindungi.</span>
            <span>Student · Create · Grow</span>
        </div>

    </div>

</footer>
