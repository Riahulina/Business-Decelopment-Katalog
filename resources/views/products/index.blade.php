@extends('layouts.bd')
@section('title', 'Produk Mahasiswa')
@section('content')

    <x-page-banner eyebrow="PRODUK BD" title="Wadah Ide, Karya, dan Kolaborasi Mahasiswa" />

    <section class="sec">
        <div class="wrap">
            @if (request('q'))
                <p style="margin-bottom:16px;color:var(--mut);font-size:13px">Hasil pencarian “{{ request('q') }}”:
                    {{ count($products) }} produk ditemukan.</p>
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
                <x-product-card :p="$p" />@empty<p style="color:var(--mut)">Belum ada produk yang cocok. Coba
                        kata kunci lain.</p>
                @endforelse
            </div>
        </div>
    </section>
    <section class="sec">
        <div class="wrap">
            <div class="sh"><span class="si"><x-i n="flame" /></span>
                <div>
                    <h2>Sedang Populer</h2>
                    <p>Kategori dan produk yang paling banyak dilirik minggu ini.</p>
                </div>
            </div>
            <div class="tr2">
                <div class="card cbar">
                    @foreach ([['Makanan & Minuman', 32], ['Fashion', 24], ['Kerajinan', 18], ['Digital', 12]] as [$c, $n])
                        <div class="cb">
                            <div class="t">{{ $c }}<em>↑ {{ $n }}%</em></div>
                            <div class="b"><i style="width:{{ $n * 3 }}%"></i></div>
                        </div>
                    @endforeach
                </div>
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

                            <span class="rk">{{ $loop->iteration }}</span>

                            <div class="ph"
                                @if ($image) style="background-image:url('{{ asset($image->image) }}'); background-size:cover; background-position:center;"
                @else
                    style="background:#f3e3d0;" @endif>
                                @if (!$image)
                                    <x-i :n="$icon" />
                                @endif
                            </div>

                            <div class="bd">

                                <b>{{ $p->name }}</b>

                                <span>
                                    Rp {{ number_format($p->price, 0, ',', '.') }}
                                </span>

                                <div class="hot">

                                    <span style="color:inherit">
                                        <x-i n="eye" />
                                        {{ [1200, 980, 870][$loop->index] ?? 870 }}
                                    </span>

                                    <span style="color:inherit">
                                        <x-i n="pin" />
                                        {{ $loop->first ? 'Paling dilihat' : 'Tren' }}
                                    </span>

                                </div>

                            </div>

                        </a>
                    @endforeach

                </div>
            </div>
        </div>
    </section>
    <section class="sec" style="padding-bottom:60px">
        <div class="wrap">
            <div class="sh"><span class="si"><x-i n="id" /></span>
                <div>
                    <h2>Sosok di Balik Produk</h2>
                    <p>Kenali mahasiswa hebat di balik setiap produk.</p>
                </div>
            </div>
            <div class="ppl2">
                @foreach ($resellers as $reseller)
                    <div class="pp">

                        <div class="ph">
                            @if ($reseller->foto)
                                <img src="{{ asset($reseller->foto) }}" alt="{{ $reseller->nama_lengkap }}"
                                    style="width:100%;height:100%;object-fit:cover;">
                            @else
                                <x-i n="user" />
                            @endif
                        </div>

                        <div>
                            <b>{{ $reseller->nama_lengkap }}</b>
                            <small>{{ $reseller->prodi }}</small>

                            <a href="{{ route('products.index', ['q' => $reseller->nama_lengkap]) }}">
                                Lihat Produk <x-i n="arr" />
                            </a>
                        </div>

                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
