@extends('layouts.dashboard')

@section('title', 'Dashboard – BD')

@php
    $reseller = auth()->user()->reseller;
    $name = $reseller?->nama_lengkap ?? auth()->user()->name;
    $initial = \Illuminate\Support\Str::upper(\Illuminate\Support\Str::substr($name, 0, 1));
    $photo = $reseller?->foto ? asset('storage/' . $reseller->foto) : null;

    $stats = [
        ['label' => 'Total Produk', 'value' => $totalProducts, 'icon' => 'bag', 'tone' => 'blue'],
        ['label' => 'Disetujui', 'value' => $approvedProducts, 'icon' => 'check', 'tone' => 'green'],
        ['label' => 'Menunggu', 'value' => $pendingProducts, 'icon' => 'clock', 'tone' => 'yellow'],
        ['label' => 'Ditolak', 'value' => $rejectedProducts, 'icon' => 'close', 'tone' => 'red'],
    ];

    $statusMap = [
        'approved' => ['Disetujui', 'approved'],
        'pending' => ['Menunggu', 'pending'],
        'rejected' => ['Ditolak', 'rejected'],
    ];
@endphp


@section('content')

    {{-- ================= HERO ================= --}}
    <section class="res-hero">

        <div class="res-welcome">

            <div class="res-welcome-eyebrow">
                <span></span>
                Dashboard Reseller
            </div>

            <h1>Halo, {{ $name }} 👋</h1>

            <p>Kelola produk dan profil bisnis kamu di BD Katalog.</p>

            <div class="res-hero-actions">
                <a href="{{ route('reseller.products.create') }}" class="btn p">
                    <x-i n="plus" />
                    Tambah Produk
                </a>

                <a href="{{ route('reseller.profile') }}" class="btn o">
                    Kelola Profil
                </a>
            </div>

        </div>


        <div class="res-profile-mini">

            <div class="res-avatar">
                @if ($photo)
                    <img src="{{ $photo }}" alt="{{ $name }}">
                @else
                    {{ $initial }}
                @endif
            </div>

            <div>
                <strong>{{ $name }}</strong>
                <span>Reseller</span>
            </div>

        </div>

    </section>


    {{-- ================= STATISTIK ================= --}}
    <section class="res-stats">

        @foreach ($stats as $stat)
            <div class="res-stat res-stat-{{ $stat['tone'] }}">

                <div class="res-stat-icon">
                    <x-i :n="$stat['icon']" />
                </div>

                <div class="res-stat-content">
                    <span>{{ $stat['label'] }}</span>
                    <strong>{{ $stat['value'] }}</strong>
                </div>

            </div>
        @endforeach

    </section>


    {{-- ================= KONTEN UTAMA ================= --}}
    <div class="res-dashboard-grid">

        {{-- PRODUK TERBARU --}}
        <section class="res-panel">

            <div class="res-panel-head">

                <div>
                    <span class="res-panel-eyebrow">Katalog Saya</span>
                    <h2>Produk Terbaru</h2>
                    <p>Produk yang terakhir kamu tambahkan.</p>
                </div>

                <a href="{{ route('reseller.products') }}" class="res-view-all">
                    Lihat semua
                    <x-i n="arr" />
                </a>

            </div>


            @forelse ($recentProducts as $product)
                @php
                    [$statusLabel, $statusClass] = $statusMap[$product->status] ?? $statusMap['rejected'];
                    $image = $product->images->first();
                @endphp

                <a href="{{ route('reseller.products.show', $product->id) }}" class="res-product-row">

                    <div class="res-product-thumb">
                        @if ($image)
                            <img src="{{ asset('storage/' . $image->image) }}" alt="{{ $product->name }}">
                        @else
                            <x-i n="bag" />
                        @endif
                    </div>

                    <div class="res-product-main">
                        <strong>{{ $product->name }}</strong>

                        <span>
                            {{ $product->category?->name ?? 'Produk' }}
                            <span class="res-price-m">· Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                        </span>
                    </div>

                    <div class="res-product-price">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </div>

                    <span class="res-status {{ $statusClass }}">{{ $statusLabel }}</span>

                    <span class="res-product-arrow"><x-i n="arr" /></span>

                </a>

            @empty

                <div class="res-empty">

                    <div class="res-empty-icon">
                        <x-i n="bag" />
                    </div>

                    <h3>Belum ada produk</h3>

                    <p>Tambahkan produk pertamamu dan mulai tampilkan karyamu di BD Katalog.</p>

                    <a href="{{ route('reseller.products.create') }}" class="btn p">
                        <x-i n="plus" />
                        Tambah Produk
                    </a>

                </div>
            @endforelse

        </section>


        {{-- PROFIL & BANTUAN --}}
        <section class="res-side-panel">

            <div class="res-side-top">

                <span class="res-panel-eyebrow">Profil Reseller</span>

                <h2>Bangun etalase<br>bisnismu.</h2>

                <p>
                    Pastikan profil dan produk kamu selalu diperbarui
                    agar lebih mudah dikenal mahasiswa lain.
                </p>

            </div>


            <div class="res-profile-box">

                <div class="res-avatar">
                    @if ($photo)
                        <img src="{{ $photo }}" alt="{{ $name }}">
                    @else
                        {{ $initial }}
                    @endif
                </div>

                <div>
                    <strong>{{ $name }}</strong>
                    <span>{{ $reseller?->prodi ?? 'Reseller BD' }}</span>
                </div>

            </div>


            <a href="{{ route('reseller.profile') }}" class="res-profile-btn">
                Lengkapi Profil
                <x-i n="arr" />
            </a>


            <div class="res-help-mini">

                <div class="res-help-icon">
                    <x-i n="chat" />
                </div>

                <div>
                    <strong>Butuh bantuan?</strong>

                    <p>Hubungi Business Development jika mengalami kendala.</p>

                    <a href="{{ route('contact') }}">
                        Hubungi BD
                        <x-i n="arr" />
                    </a>
                </div>

            </div>

        </section>

    </div>


    {{-- ================= INFO BAWAH ================= --}}
    <section class="res-bottom-info">

        <div class="res-bottom-icon">
            <x-i n="sparkle" />
        </div>

        <div>
            <strong>Jadikan produkmu lebih dikenal.</strong>

            <p>
                Pastikan foto, deskripsi, harga, dan informasi produk
                sudah lengkap sebelum diajukan.
            </p>
        </div>

        <a href="{{ route('reseller.products.create') }}" class="res-bottom-btn">
            Tambah Produk
            <x-i n="arr" />
        </a>

    </section>

@endsection
