@extends('layouts.bd')

@section('title', 'Produk Mahasiswa')

@section('content')

    <x-page-banner eyebrow="PRODUK BD" title="Wadah Ide, Karya, dan Kolaborasi Mahasiswa" />

    {{-- =========================================================
         SEMUA PRODUK
    ========================================================== --}}
    <section class="sec">

        <div class="wrap">

            @if (request('q'))
                <p style="margin-bottom:16px;color:var(--mut);font-size:13px">
                    Hasil pencarian “{{ request('q') }}”:
                    {{ count($products) }} produk ditemukan.
                </p>
            @endif

            <div class="tabs" data-t=".pgrid .pd">

                <a class="tab {{ !request('category') ? 'on' : '' }}" href="{{ route('products.index') }}">
                    Semua
                </a>

                @foreach ($categories as $category)
                    <a class="tab {{ request('category') === $category->slug ? 'on' : '' }}"
                        href="{{ route('products.index', ['category' => $category->slug]) }}">
                        {{ $category->name }}
                    </a>
                @endforeach

            </div>

            <div class="pgrid">

                @forelse($products as $p)
                    <x-product-card :p="$p" />

                @empty

                    <p style="color:var(--mut)">
                        Belum ada produk yang cocok.
                        Coba kata kunci lain.
                    </p>
                @endforelse

            </div>

        </div>

    </section>


    {{-- =========================================================
         SEDANG POPULER
    ========================================================== --}}
    <section class="sec">

        <div class="wrap">

            <div class="sh">

                <span class="si">
                    <x-i n="flame" />
                </span>

                <div>
                    <h2>Sedang Populer</h2>

                    <p>
                        Produk pilihan yang sedang ditampilkan sebagai populer oleh BD.
                    </p>
                </div>

            </div>


            @if ($popularProducts->count())

                <div class="tr2">

                    {{-- INFO POPULER --}}
                    <div class="card cbar">

                        <div class="cb">

                            <div class="t">
                                Produk Pilihan BD

                                <em>
                                    {{ $popularProducts->count() }} produk
                                </em>
                            </div>

                            <p style="margin:8px 0 0;color:var(--mut);font-size:12px;line-height:1.6;">
                                Produk yang ditandai sebagai populer oleh admin
                                akan tampil di bagian ini.
                            </p>

                        </div>

                    </div>


                    {{-- PRODUK POPULER --}}
                    <div class="tops">

                        @foreach ($popularProducts as $p)
                            @php

                                $image = $p->images->first();

                                $icon = match ($p->category?->name) {
                                    'Makanan & Minuman' => 'cup',
                                    'Fashion' => 'bag',
                                    'Craft' => 'sparkle',
                                    'Digital' => 'bulb',
                                    'Jasa' => 'wrench',
                                    'Stationery' => 'book',
                                    'Beauty & Health' => 'heart',

                                    default => 'bag',
                                };

                            @endphp


                            <a class="card tk" href="{{ route('products.show', $p->slug) }}">

                                {{-- RANK --}}
                                <span class="rk">
                                    {{ $loop->iteration }}
                                </span>


                                {{-- FOTO --}}
                                <div class="ph"
                                    @if ($image) style="
                                            background-image:url('{{ asset($image->image) }}');
                                            background-size:cover;
                                            background-position:center;
                                        "

                                    @else

                                        style="background:#f3e3d0;" @endif>

                                    @if (!$image)
                                        <x-i :n="$icon" />
                                    @endif

                                </div>


                                {{-- INFO --}}
                                <div class="bd">

                                    <b>
                                        {{ $p->name }}
                                    </b>

                                    <span>
                                        Rp {{ number_format($p->price, 0, ',', '.') }}
                                    </span>


                                    <div class="hot">

                                        <span style="color:inherit">
                                            <x-i n="pin" />
                                            Populer
                                        </span>


                                        @if ($p->category)
                                            <span style="color:inherit">

                                                <x-i n="tag" />

                                                {{ $p->category->name }}

                                            </span>
                                        @endif

                                    </div>

                                </div>

                            </a>
                        @endforeach

                    </div>

                </div>
            @else
                <div class="card" style="padding:30px;text-align:center;color:var(--mut);">

                    <x-i n="flame" />

                    <h3 style="margin:10px 0 5px;color:var(--ink);">
                        Belum ada produk populer
                    </h3>

                    <p style="margin:0;font-size:12px;">
                        Admin dapat menandai produk sebagai populer
                        melalui panel admin.
                    </p>

                </div>

            @endif

        </div>

    </section>


    {{-- =========================================================
         PRODUK BARU
    ========================================================== --}}
    <section class="sec">

        <div class="wrap">

            <div class="sh">

                <span class="si">
                    <x-i n="sparkle" />
                </span>

                <div>
                    <h2>Produk Baru</h2>

                    <p>
                        Produk terbaru yang baru ditambahkan ke BD Katalog.
                    </p>
                </div>

            </div>


            @if ($newProducts->count())

                <div class="pgrid">

                    @foreach ($newProducts as $p)
                        <x-product-card :p="$p" />
                    @endforeach

                </div>
            @else
                <div class="card" style="padding:30px;text-align:center;color:var(--mut);">

                    <x-i n="sparkle" />

                    <h3 style="margin:10px 0 5px;color:var(--ink);">
                        Belum ada produk baru
                    </h3>

                    <p style="margin:0;font-size:12px;">
                        Produk yang ditandai sebagai produk baru
                        oleh admin akan muncul di sini.
                    </p>

                </div>

            @endif

        </div>

    </section>


    {{-- =========================================================
     SOSOK DI BALIK PRODUK
========================================================== --}}
    <section class="sec" style="padding-bottom:60px">

        <div class="wrap">

            <div class="sh">

                <span class="si">
                    <x-i n="id" />
                </span>

                <div>
                    <h2>Sosok di Balik Produk</h2>
                    <p>Kenali mahasiswa hebat di balik setiap produk.</p>
                </div>

            </div>


            @if ($resellers->count())

                <div class="crew">

                    @foreach ($resellers as $reseller)
                        <article class="crew-card">

                            <div class="crew-photo">
                                {{-- inisial tampil kalau foto kosong / gagal dimuat --}}
                                <span class="crew-initial">
                                    {{ \Illuminate\Support\Str::upper(\Illuminate\Support\Str::substr($reseller->nama_lengkap, 0, 1)) }}
                                </span>

                                @if ($reseller->foto_url)
                                    <img src="{{ $reseller->foto_url }}" alt="{{ $reseller->nama_lengkap }}"
                                        loading="lazy" onerror="this.remove()">
                                @endif
                            </div>

                            <div class="crew-info">

                                <b>{{ $reseller->nama_lengkap }}</b>

                                <small>{{ $reseller->prodi ?: 'Mahasiswa BD' }}</small>

                                <a class="crew-btn" href="{{ route('products.index', ['q' => $reseller->nama_lengkap]) }}">
                                    Lihat Produk
                                    <x-i n="arr" />
                                </a>

                            </div>

                        </article>
                    @endforeach

                </div>
            @else
                <div class="card" style="padding:30px;text-align:center;color:var(--mut);">
                    <x-i n="id" />

                    <h3 style="margin:10px 0 5px;color:var(--ink);">Belum ada profil</h3>

                    <p style="margin:0;font-size:12px;">Profil mahasiswa penjual akan tampil di sini.</p>
                </div>
            @endif

        </div>

    </section>

@endsection
