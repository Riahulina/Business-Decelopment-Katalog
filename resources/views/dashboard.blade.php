@extends('layouts.dashboard')

@section('title', 'Dashboard – BD')

@section('content')

    <div class="dash-top">

        <div>
            <p class="dash-eyebrow">Dashboard Reseller</p>

            <h1 class="dash-h1">
                Selamat datang,
                {{ auth()->user()->reseller?->nama_lengkap ?? auth()->user()->name }}
                👋
            </h1>

            <p class="dash-sub">
                Kelola produk dan profil bisnis kamu di BD Katalog.
            </p>
        </div>

        <div class="dash-user">

            <div class="av lg">
                <x-i n="user" />
            </div>

            <div>
                <strong>
                    {{ auth()->user()->reseller?->nama_lengkap ?? auth()->user()->name }}
                </strong>

                <span>Reseller</span>
            </div>

        </div>

    </div>


    {{-- ================================
         STATISTIK PRODUK
    ================================= --}}

    <div class="dash-stats">

        <div class="dash-stat">

            <div class="si blue">
                <x-i n="bag" />
            </div>

            <div>
                <span>Total Produk</span>
                <strong>{{ $totalProducts }}</strong>
            </div>

        </div>


        <div class="dash-stat">

            <div class="si ok">
                <x-i n="check" />
            </div>

            <div>
                <span>Disetujui</span>
                <strong>{{ $approvedProducts }}</strong>
            </div>

        </div>


        <div class="dash-stat">

            <div class="si warn">
                <x-i n="clock" />
            </div>

            <div>
                <span>Menunggu</span>
                <strong>{{ $pendingProducts }}</strong>
            </div>

        </div>


        <div class="dash-stat">

            <div class="si bad">
                <x-i n="close" />
            </div>

            <div>
                <span>Ditolak</span>
                <strong>{{ $rejectedProducts }}</strong>
            </div>

        </div>

    </div>


    {{-- ================================
         DASHBOARD CONTENT
    ================================= --}}

    <div class="dash-grid">

        {{-- PRODUK TERBARU --}}
        <section class="dash-card">

            <div class="dash-card-h">

                <div>

                    <p class="dash-eyebrow">
                        Produk
                    </p>

                    <h2>
                        Produk Terbaru
                    </h2>

                </div>

                <a href="{{ route('reseller.products') }}" class="dash-more">
                    Lihat Semua
                    <x-i n="arr" />
                </a>

            </div>


            @if ($recentProducts->count())

                <div class="dash-products">

                    @foreach ($recentProducts as $product)
                        <div class="dash-product">

                            <div class="dash-product-info">

                                <strong>
                                    {{ $product->name }}
                                </strong>

                                <span>
                                    {{ $product->category?->name ?? 'Produk' }}
                                </span>

                            </div>


                            <div class="dash-product-status">

                                @if ($product->status === 'approved')
                                    <span class="status approved">
                                        Disetujui
                                    </span>
                                @elseif ($product->status === 'pending')
                                    <span class="status pending">
                                        Menunggu
                                    </span>
                                @else
                                    <span class="status rejected">
                                        Ditolak
                                    </span>
                                @endif

                            </div>

                        </div>
                    @endforeach

                </div>
            @else
                <div class="dash-empty">

                    <div class="dash-empty-ic">
                        <x-i n="bag" />
                    </div>

                    <h3>
                        Belum ada produk
                    </h3>

                    <p>
                        Tambahkan produk pertamamu dan mulai tampilkan
                        karyamu di BD Katalog.
                    </p>

                    <a href="{{ route('reseller.products.create') }}" class="btn p">
                        <x-i n="plus" />
                        Tambah Produk
                    </a>

                </div>

            @endif

        </section>


        {{-- INFORMASI --}}
        <section class="dash-card">

            <div class="dash-card-h">

                <div>

                    <p class="dash-eyebrow">
                        Informasi
                    </p>

                    <h2>
                        Perlu Bantuan?
                    </h2>

                </div>

            </div>


            <div class="dash-info">

                <div class="dash-info-ic">
                    <x-i n="chat" />
                </div>

                <p>
                    Bingung cara menambahkan produk atau mengelola
                    profilmu? Hubungi Business Development untuk
                    mendapatkan bantuan.
                </p>

                <a href="{{ route('contact') }}" class="btn o">
                    Hubungi BD
                    <x-i n="arr" />
                </a>

            </div>

        </section>

    </div>

@endsection
