@extends('layouts.dashboard')

@section('title', 'Detail Produk – BD')

@section('content')

    @php
        $status = match ($product->status) {
            'approved' => ['ok', 'Disetujui'],
            'rejected' => ['bad', 'Ditolak'],
            default => ['warn', 'Menunggu'],
        };

        $first = $product->images->first();
    @endphp

    <div class="dash-top">

        <div>
            <p class="dash-eyebrow">Detail Produk</p>
            <h1 class="dash-h1">{{ $product->name }}</h1>
            <p class="dash-sub">Informasi lengkap produk yang kamu ajukan ke BD Katalog.</p>
        </div>

        <div class="dash-top-actions">

            <a href="{{ route('reseller.products') }}" class="btn o">
                <svg class="i" viewBox="0 0 24 24" style="transform:rotate(180deg)">
                    <path d="M5 12h14M13 6l6 6-6 6" />
                </svg>
                Kembali
            </a>

            <form method="POST" action="{{ route('reseller.products.destroy', $product->id) }}"
                onsubmit="return confirm('Hapus produk ini? Tindakan ini tidak bisa dibatalkan.')">
                @csrf
                @method('DELETE')

                <button type="submit" class="btn danger">
                    <svg class="i" viewBox="0 0 24 24">
                        <path d="M4 7h16M10 11v6M14 11v6M6 7l1 12a2 2 0 002 2h6a2 2 0 002-2l1-12M9 7V4h6v3" />
                    </svg>
                    Hapus
                </button>
            </form>

        </div>

    </div>


    <div class="pd-layout">

        {{-- ================= GALERI ================= --}}
        <div class="dash-card pd-gallery">

            <div class="pd-main">
                @if ($first)
                    <img id="pd-main-img" src="{{ asset('storage/' . $first->image) }}" alt="{{ $product->name }}">
                @else
                    <div class="pd-none">
                        <x-i n="bag" />
                        <span>Belum ada gambar</span>
                    </div>
                @endif
            </div>

            @if ($product->images->count() > 1)
                <div class="pd-thumbs">
                    @foreach ($product->images as $img)
                        <button type="button" class="pd-thumb {{ $loop->first ? 'on' : '' }}"
                            data-src="{{ asset('storage/' . $img->image) }}" aria-label="Foto {{ $loop->iteration }}">
                            <img src="{{ asset('storage/' . $img->image) }}" alt="Foto {{ $loop->iteration }}">
                        </button>
                    @endforeach
                </div>
            @endif

        </div>


        {{-- ================= INFORMASI ================= --}}
        <div class="dash-card pd-info">

            <div class="pd-head">

                <div>
                    <span class="pd-label">Nama Produk</span>
                    <h2>{{ $product->name }}</h2>
                </div>

                <span class="badge {{ $status[0] }}">{{ $status[1] }}</span>

            </div>

            <div class="pd-price">
                Rp {{ number_format($product->price, 0, ',', '.') }}
            </div>


            <div class="pd-grid">

                <div class="pd-item">
                    <span>Kategori</span>
                    <strong>{{ $product->category->name ?? '-' }}</strong>
                </div>

                <div class="pd-item">
                    <span>Status</span>
                    <strong>{{ $status[1] }}</strong>
                </div>

                <div class="pd-item">
                    <span>Diajukan</span>
                    <strong>{{ $product->created_at?->format('d M Y') ?? '-' }}</strong>
                </div>

                <div class="pd-item">
                    <span>Terakhir diperbarui</span>
                    <strong>{{ $product->updated_at?->format('d M Y') ?? '-' }}</strong>
                </div>

            </div>


            <div class="pd-section">
                <h3>Deskripsi Produk</h3>
                <p>{{ $product->description }}</p>
            </div>


            @if ($product->highlights->count())
                <div class="pd-section">

                    <h3>Keunggulan Produk</h3>

                    <div class="pd-hl-list">
                        @foreach ($product->highlights as $highlight)
                            <div class="pd-hl">

                                <div class="pd-hl-ic">
                                    @if ($highlight->icon)
                                        {{ $highlight->icon }}
                                    @else
                                        <x-i n="sparkle" />
                                    @endif
                                </div>

                                <div>
                                    <strong>{{ $highlight->title }}</strong>

                                    @if ($highlight->description)
                                        <p>{{ $highlight->description }}</p>
                                    @endif
                                </div>

                            </div>
                        @endforeach
                    </div>

                </div>
            @endif


            @if ($product->status === 'rejected' && $product->rejection_reason)
                <div class="pd-reject">

                    <div class="pd-reject-ic">
                        <x-i n="close" />
                    </div>

                    <div>
                        <strong>Alasan Pengajuan Ditolak</strong>
                        <p>{{ $product->rejection_reason }}</p>
                    </div>

                </div>
            @endif

        </div>

    </div>

@endsection


@push('scripts')
    <script>
        /* Klik thumbnail -> ganti foto utama */
        const mainImg = document.getElementById('pd-main-img');

        document.querySelectorAll('.pd-thumb').forEach(btn => {
            btn.addEventListener('click', () => {
                if (!mainImg) return;

                mainImg.src = btn.dataset.src;

                document.querySelectorAll('.pd-thumb').forEach(t => t.classList.remove('on'));
                btn.classList.add('on');
            });
        });
    </script>
@endpush
