@extends('layouts.bd')

@section('title', $product->name . ' – BD')

@section('content')

    <x-page-banner eyebrow="PRODUK BD" title="Wadah Ide, Karya, dan Kolaborasi Mahasiswa" />

    {{-- ================================
         DETAIL PRODUK
    ================================= --}}
    <section class="sec product-detail-page" style="padding-bottom:40px">
        <div class="wrap">

            <div class="crumb">
                <a href="{{ route('products.index') }}">
                    Produk
                </a>
                /
                {{ $product->name }}
            </div>

            <div class="dt2">

                @php
                    use Illuminate\Support\Facades\Storage;

                    $image = $product->images->first();

                    $icon = match ($product->category?->name) {
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


                {{-- =================================
                     FOTO PRODUK
                ================================== --}}
                <div class="product-gallery">

                    {{-- FOTO UTAMA --}}
                    <div class="card big product-main-image" id="mainProductImage">

                        @if ($image)
                            <img src="{{ Storage::url($image->image) }}" alt="{{ $product->name }}" id="mainImage">
                        @else
                            <div class="product-no-image">
                                <x-i :n="$icon" />
                            </div>
                        @endif

                    </div>


                    {{-- THUMBNAIL FOTO --}}
                    @if ($product->images->count() > 1)

                        <div class="product-thumbnails">

                            @foreach ($product->images as $index => $productImage)
                                <button type="button" class="product-thumb {{ $index === 0 ? 'active' : '' }}"
                                    onclick="changeProductImage('{{ Storage::url($productImage->image) }}', this)"
                                    aria-label="Lihat foto {{ $index + 1 }}">

                                    <img src="{{ Storage::url($productImage->image) }}"
                                        alt="{{ $product->name }} - foto {{ $index + 1 }}">

                                </button>
                            @endforeach

                        </div>

                    @endif

                </div>


                {{-- =================================
                     INFORMASI PRODUK
                ================================== --}}
                <div>

                    <span class="pill">
                        {{ $product->category?->name ?? 'Produk' }}
                    </span>

                    <h1>
                        {{ $product->name }}
                    </h1>

                    <div class="prc">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </div>

                    <p>
                        {{ $product->description }}
                    </p>


                    {{-- PENJUAL --}}
                    <div class="by">

                        <span class="av">
                            <x-i n="user" />
                        </span>

                        Dijual oleh
                        {{ $product->reseller?->nama_lengkap ?? 'Mahasiswa' }}

                    </div>


                    {{-- PRODI --}}
                    @if ($product->reseller?->prodi)
                        <small style="display:block;margin-top:6px;color:var(--mut)">
                            {{ $product->reseller->prodi }}
                        </small>
                    @endif


                    {{-- TOMBOL --}}
                    <div class="cta">

                        @php
                            $whatsapp = preg_replace('/[^0-9]/', '', $product->reseller?->whatsapp ?? '');

                            if (str_starts_with($whatsapp, '0')) {
                                $whatsapp = '62' . substr($whatsapp, 1);
                            }

                            $message = urlencode(
                                "Halo kak {$product->reseller?->nama_lengkap}! \n\n" .
                                    "Saya tertarik dengan produk berikut dari BD Katalog:\n\n" .
                                    "🛍️ *{$product->name}*\n" .
                                    '💰 Rp ' .
                                    number_format($product->price, 0, ',', '.') .
                                    "\n" .
                                    '🔗 ' .
                                    route('products.show', $product->slug) .
                                    "\n\n" .
                                    'Apakah produk ini masih tersedia? Terima kasih ',
                            );
                        @endphp


                        @if ($whatsapp)
                            <a class="btn p" href="https://wa.me/{{ $whatsapp }}?text={{ $message }}"
                                target="_blank" rel="noopener">

                                <x-i n="phone" />

                                Hubungi Penjual

                            </a>
                        @endif


                        <button type="button" class="btn o like-btn" id="likeButton" data-product="{{ $product->id }}">
                            <x-i n="heart" />
                            <span id="likeText">Suka</span>
                            <span id="likeCount">0</span>
                        </button>

                    </div>

                </div>

            </div>

        </div>
    </section>


    {{-- ================================
         KEUNGGULAN PRODUK
    ================================= --}}
    @if ($product->highlights->count())

        <section class="sec product-highlights">

            <div class="wrap">

                <div class="sh">

                    <span class="si">
                        <x-i n="sparkle" />
                    </span>

                    <div>

                        <h2>
                            Keunggulan Produk
                        </h2>

                        <p>
                            Hal menarik dari produk ini.
                        </p>

                    </div>

                </div>


                <div class="highlight-grid">

                    @foreach ($product->highlights as $highlight)
                        <div class="highlight-card">

                            <div class="highlight-icon">

                                <x-i :n="$highlight->icon ?? 'sparkle'" />

                            </div>

                            <div>

                                <b>
                                    {{ $highlight->title }}
                                </b>

                                @if ($highlight->description)
                                    <p>
                                        {{ $highlight->description }}
                                    </p>
                                @endif

                            </div>

                        </div>
                    @endforeach

                </div>

            </div>

        </section>

    @endif


    {{-- ================================
         PRODUK SERUPA
    ================================= --}}
    <section class="sec product-related" style="padding-bottom:60px">

        <div class="wrap">

            <div class="sh">

                <span class="si">
                    <x-i n="bag" />
                </span>

                <div>

                    <h2>
                        Produk Lainnya
                    </h2>

                    <p>
                        Mungkin kamu juga suka.
                    </p>

                </div>

            </div>


            <div class="pgrid">

                @forelse ($similarProducts as $r)
                    <x-product-card :p="$r" />

                @empty

                    <p style="color:var(--mut)">
                        Belum ada produk serupa.
                    </p>
                @endforelse

            </div>

        </div>

    </section>


    {{-- ================================
         GANTI FOTO PRODUK
    ================================= --}}
    <script>
        function changeProductImage(imageUrl, button) {

            const mainImage = document.getElementById('mainImage');

            if (mainImage) {

                mainImage.style.opacity = '0';

                setTimeout(() => {

                    mainImage.src = imageUrl;
                    mainImage.style.opacity = '1';

                }, 150);

            }


            document
                .querySelectorAll('.product-thumb')
                .forEach(thumb => {

                    thumb.classList.remove('active');

                });


            button.classList.add('active');
        }


        function changeProductImage(imageUrl, button) {
            const mainImage = document.getElementById('mainImage');

            if (mainImage) {
                mainImage.style.opacity = '0';

                setTimeout(() => {
                    mainImage.src = imageUrl;
                    mainImage.style.opacity = '1';
                }, 150);
            }

            document
                .querySelectorAll('.product-thumb')
                .forEach(thumb => {
                    thumb.classList.remove('active');
                });

            button.classList.add('active');
        }


        /* ==============================
           LIKE PRODUK
           ============================== */

        document.addEventListener('DOMContentLoaded', function() {

            const likeButton = document.getElementById('likeButton');
            const likeText = document.getElementById('likeText');
            const likeCount = document.getElementById('likeCount');

            if (!likeButton || !likeText || !likeCount) {
                return;
            }

            const productId = likeButton.dataset.product;

            const countKey = 'bd_like_count_' + productId;
            const likedKey = 'bd_liked_' + productId;

            let count = parseInt(
                localStorage.getItem(countKey) || '0',
                10
            );

            let liked =
                localStorage.getItem(likedKey) === 'true';


            function updateLikeButton() {

                likeCount.textContent = count;

                if (liked) {
                    likeButton.classList.add('liked');
                    likeText.textContent = 'Disukai';
                } else {
                    likeButton.classList.remove('liked');
                    likeText.textContent = 'Suka';
                }
            }


            likeButton.addEventListener('click', function() {

                if (liked) {
                    count = Math.max(0, count - 1);
                    liked = false;
                } else {
                    count++;
                    liked = true;
                }

                localStorage.setItem(
                    countKey,
                    count
                );

                localStorage.setItem(
                    likedKey,
                    liked
                );

                updateLikeButton();
            });


            updateLikeButton();

        });
    </script>

@endsection
@push('styles')
    <style>
        .like-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
        }

        .like-btn .i {
            transition:
                transform .2s ease,
                color .2s ease;
        }

        .like-btn:hover .i {
            transform: scale(1.08);
        }

        .like-btn.liked {
            color: #e2556d;
            border-color: #f2b7c2;
            background: #fff5f7;
        }

        .like-btn.liked .i {
            fill: currentColor;
            color: #e2556d;
        }

        #likeCount {
            font-size: 12px;
            font-weight: 700;
            min-width: 12px;
        }
    </style>
@endpush
