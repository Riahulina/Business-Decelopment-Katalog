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
            <p class="dash-sub">
                Semua produk yang sudah kamu tambahkan ke katalog BD.
            </p>
        </div>

        <div class="dash-top-actions">
            @unless ($products->isEmpty())
                <span class="dash-count">
                    {{ $products->count() }} produk
                </span>
            @endunless

            <a href="{{ route('reseller.products.create') }}" class="btn p">
                <x-i n="plus" />
                Tambah Produk
            </a>
        </div>
    </div>

    {{-- STATUS PENGAJUAN --}}
    @if (session('status'))
        <div class="dash-flash">
            {{ session('status') }}
        </div>
    @endif

    {{-- NOTIFIKASI WHATSAPP --}}
    @if (session('whatsapp_url'))
        <div class="dash-card" style="margin-bottom:20px;display:flex;align-items:center;gap:16px;flex-wrap:wrap;">
            <div class="dash-empty-ic" style="margin:0;flex:none;">
                <x-i n="sparkle" />
            </div>

            <div style="flex:1;min-width:220px;">
                <strong style="color:var(--pri);font-size:14px;display:block;">
                    Produk "{{ session('whatsapp_product') }}" berhasil diajukan
                </strong>

                <p style="margin:4px 0 0;font-size:12.5px;color:var(--mut);">
                    Produk kamu sedang menunggu persetujuan admin.
                    Konfirmasi pengajuan melalui WhatsApp Admin BD.
                </p>
            </div>

            <a href="{{ session('whatsapp_url') }}" target="_blank" rel="noopener noreferrer" class="btn p">
                <x-i n="phone" />
                Konfirmasi ke WA Admin
            </a>
        </div>
    @endif

    {{-- DAFTAR PRODUK --}}
    @if ($products->isEmpty())

        <div class="dash-card">
            <div class="dash-empty">

                <div class="dash-empty-ic">
                    <x-i n="bag" />
                </div>

                <h3>Belum ada produk</h3>

                <p>
                    Tambahkan produk pertamamu dan mulai tampilkan
                    karyamu di BD Katalog.
                </p>

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

                            {{-- PRODUK --}}
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

                            {{-- KATEGORI --}}
                            <td data-label="Kategori">
                                {{ $p->category->name ?? '-' }}
                            </td>

                            {{-- HARGA --}}
                            <td data-label="Harga" class="num">
                                Rp {{ number_format($p->price, 0, ',', '.') }}
                            </td>

                            {{-- STATUS --}}
                            <td data-label="Status">

                                <span class="badge {{ $st[0] }}">
                                    {{ $st[1] }}
                                </span>

                            </td>

                            {{-- AKSI --}}
                            <td class="cell-act">

                                <div class="dt-act">

                                    {{-- DETAIL --}}
                                    <a href="{{ route('reseller.products.show', $p->id) }}" class="dt-ic"
                                        title="Lihat detail" aria-label="Lihat detail {{ $p->name }}">
                                        <svg class="i" viewBox="0 0 24 24">
                                            <path d="M2 12s4-7 10-7 10 7 10 7-4 7-10 7S2 12 2 12z" />
                                            <circle cx="12" cy="12" r="3" />
                                        </svg>
                                    </a>

                                    {{-- HAPUS / BATALKAN --}}
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


{{-- ========================================================= --}}
{{-- BUKA WHATSAPP OTOMATIS DI TAB BARU                       --}}
{{-- ========================================================= --}}

@if (session('whatsapp_url'))
    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {

                const whatsappUrl = @json(session('whatsapp_url'));

                if (!whatsappUrl) {
                    return;
                }

                const whatsappWindow = window.open(
                    whatsappUrl,
                    '_blank',
                    'noopener,noreferrer'
                );

                /*
                 * Kalau browser memblokir popup,
                 * tombol "Konfirmasi ke WA Admin"
                 * di halaman tetap bisa digunakan.
                 */
                if (!whatsappWindow) {
                    console.log('WhatsApp diblokir oleh browser.');
                }

            });
        </script>
    @endpush
@endif
