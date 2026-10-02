@extends('layouts.dashboard')

@section('title', 'Produk Saya – BD')

@section('content')

    @php
        $statusMap = [
            'pending' => ['warn', 'Menunggu'],
            'approved' => ['ok', 'Disetujui'],
            'rejected' => ['bad', 'Ditolak'],
        ];
    @endphp

    <div class="dash-top">

        <div>
            <p class="dash-eyebrow">Kelola Produk</p>
            <h1 class="dash-h1">Produk Saya</h1>
            <p class="dash-sub">Semua produk yang sudah kamu tambahkan ke katalog BD.</p>
        </div>

        <div class="dash-top-actions">
            @unless ($products->isEmpty())
                <span class="dash-count">{{ $products->count() }} produk</span>
            @endunless

            <a href="{{ route('reseller.products.create') }}" class="btn p">
                <x-i n="plus" />
                Tambah Produk
            </a>
        </div>

    </div>


    @if (session('status'))
        <div class="dash-flash">{{ session('status') }}</div>
    @endif


    @if ($products->isEmpty())

        <div class="dash-card">
            <div class="dash-empty">
                <div class="dash-empty-ic"><x-i n="bag" /></div>
                <h3>Belum ada produk</h3>
                <p>Tambahkan produk pertamamu dan mulai tampilkan karyamu di BD Katalog.</p>
                <a href="{{ route('reseller.products.create') }}" class="btn p">
                    <x-i n="plus" />
                    Tambah Produk
                </a>
            </div>
        </div>
    @else
        <div class="dash-table-wrap">
            <table class="dash-table">

                <thead>
                    <tr>
                        <th>Produk</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($products as $p)
                        @php
                            $image = $p->images->first();
                            $st = $statusMap[$p->status] ?? $statusMap['pending'];
                        @endphp

                        <tr>

                            <td class="cell-prod">
                                <div class="dt-prod">
                                    <div class="dt-thumb">
                                        @if ($image)
                                            <img src="{{ asset('storage/' . $image->image) }}" alt="{{ $p->name }}">
                                        @else
                                            <x-i n="bag" />
                                        @endif
                                    </div>

                                    <b>{{ $p->name }}</b>
                                </div>
                            </td>

                            <td data-label="Kategori">{{ $p->category->name ?? '-' }}</td>

                            <td data-label="Harga" class="num">
                                Rp {{ number_format($p->price, 0, ',', '.') }}
                            </td>

                            <td data-label="Status">
                                <span class="badge {{ $st[0] }}">{{ $st[1] }}</span>
                            </td>

                            <td class="cell-act">
                                <div class="dt-act">

                                    <a href="{{ route('reseller.products.show', $p->id) }}" class="dt-ic"
                                        title="Lihat detail" aria-label="Lihat detail {{ $p->name }}">
                                        <svg class="i" viewBox="0 0 24 24">
                                            <path d="M2 12s4-7 10-7 10 7 10 7-4 7-10 7S2 12 2 12z" />
                                            <circle cx="12" cy="12" r="3" />
                                        </svg>
                                    </a>

                                    <form method="POST" action="{{ route('reseller.products.destroy', $p->id) }}"
                                        onsubmit="return confirm('Hapus produk &quot;{{ addslashes($p->name) }}&quot;? Tindakan ini tidak bisa dibatalkan.')">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="dt-ic bad" title="Hapus produk"
                                            aria-label="Hapus {{ $p->name }}">
                                            <svg class="i" viewBox="0 0 24 24">
                                                <path
                                                    d="M4 7h16M10 11v6M14 11v6M6 7l1 12a2 2 0 002 2h6a2 2 0 002-2l1-12M9 7V4h6v3" />
                                            </svg>
                                        </button>
                                    </form>

                                </div>
                            </td>

                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    @endif

@endsection
