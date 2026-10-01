@extends('layouts.dashboard')
@section('title', 'Produk Saya – BD')

@section('content')
    <div class="dash-top">
        <div>
            <p class="dash-eyebrow">Kelola Produk</p>
            <h1 class="dash-h1">Produk Saya</h1>
            <p class="dash-sub">Semua produk yang sudah kamu tambahkan ke katalog BD.</p>
        </div>

    </div>

    @if ($products->isEmpty())
        <div class="dash-card">
            <div class="dash-empty">
                <div class="dash-empty-ic"><x-i n="bag" /></div>
                <h3>Belum ada produk</h3>
                <p>Tambahkan produk pertamamu dan mulai tampilkan karyamu di BD Katalog.</p>
                <a href="#" class="btn p"><x-i n="plus" /> Tambah Produk</a>
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
                        <tr>
                            <td class="dt-prod">
                                <div class="dt-thumb">
                                    @if ($p->cover_image ?? false)
                                        <img src="{{ asset('storage/' . $p->cover_image) }}" alt="{{ $p->name }}">
                                    @else
                                        <x-i n="bag" />
                                    @endif
                                </div>
                                <span>{{ $p->name }}</span>
                            </td>
                            <td>{{ $p->category->name ?? '-' }}</td>
                            <td>Rp {{ number_format($p->price, 0, ',', '.') }}</td>
                            <td>
                                @php $st = ['pending'=>['warn','Menunggu'],'approved'=>['ok','Disetujui'],'rejected'=>['bad','Ditolak']][$p->status] ?? ['warn','Menunggu']; @endphp
                                <span class="badge {{ $st[0] }}">{{ $st[1] }}</span>
                            </td>
                            <td class="dt-act">
                                <a href="#" class="dt-ic"><x-i n="user" /></a>
                                <button class="dt-ic bad"><x-i n="close" /></button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection
