@extends('layouts.bd')
@section('content')
    <div class="hero">
        <div class="blob" style="width:220px;height:220px;left:-90px;top:120px"></div>
        <div class="blob" style="width:160px;height:160px;right:-50px;top:10px"></div>
        <div class="wrap">
            <div class="hg">
                <div>
                    <span class="tag"><svg class="i">
                            <use href="#i-sparkle" />
                        </svg> #StudentBusinessPlatform</span>
                    <h1>Ide Mahasiswa,<br><i>Peluang</i> Tanpa Batas</h1>
                    <p class="lead">Temukan, dukung, dan kembangkan produk mahasiswa yang penuh kreativitas dan potensi di
                        satu platform. Dari ide kecil, untuk dampak besar.</p>
                    <div class="cta"><a href="{{ route('products.index') }}" class="btn p">Jelajahi Produk <svg
                                class="i">
                                <use href="#i-arr" />
                            </svg></a></div>
                </div>
                <div class="vis">
                    <div class="script1">Connect. Grow. Lead.<svg class="i">
                            <use href="#i-sparkle" />
                        </svg></div>

                    <div class="fc" style="top:350px;left:10%">
                        <div class="im" style="background:#f3e3d0"><svg class="i">
                                <use href="#i-cup" />
                            </svg></div>
                        <div class="r"><span>Es Kopi Susu<small>Rp 15.000</small></span><em><svg class="i">
                                    <use href="#i-arr" />
                                </svg></em></div>
                    </div>
                    <div class="fc" style="bottom:120px;left:-4%">
                        <div class="im" style="background:#e9d7c5"><svg class="i">
                                <use href="#i-bag" />
                            </svg></div>
                        <div class="r"><span>Crochet Bag<small>Rp 85.000</small></span><em><svg class="i">
                                    <use href="#i-arr" />
                                </svg></em></div>
                    </div>
                    <div class="fc" style="top:210px;right:-26px;animation-delay:1s">
                        <div class="im" style="background:#dbe8c4"><svg class="i">
                                <use href="#i-cookie" />
                            </svg></div>
                        <div class="r"><span>Matcha Cookies<small>Rp 25.000</small></span><em><svg class="i">
                                    <use href="#i-arr" />
                                </svg></em></div>
                    </div>
                    <div class="fc" style="top:350px;right:30px;animation-delay:2s">
                        <div class="im" style="background:#eee5d3"><svg class="i">
                                <use href="#i-bag" />
                            </svg></div>
                        <div class="r"><span>Tote Bag Canvas<small>Rp 75.000</small></span><em><svg class="i">
                                    <use href="#i-arr" />
                                </svg></em></div>
                    </div>
                    <div class="car" id="car">
                        <div class="track" id="track"></div>
                    </div>
                    <div class="ctrl"><button class="ar" id="pv" aria-label="Sebelumnya">‹</button>
                        <div class="dots" id="dots"></div><span class="cnt" id="cnt">1 / 4</span><button
                            class="ar" id="nx" aria-label="Berikutnya">›</button>
                    </div>
                </div>
            </div>

            <div class="strip">
                <div class="card feat">
                    <div class="h">Lebih dari<br>Sekadar Produk</div>
                    <div class="f">
                        <div class="fi"><svg class="i">
                                <use href="#i-bulb" />
                            </svg></div><b>Temukan</b><small>Jelajahi beragam produk kreatif mahasiswa.</small>
                    </div>
                    <div class="f">
                        <div class="fi"><svg class="i">
                                <use href="#i-users" />
                            </svg></div><b>Dukung</b><small>Beri apresiasi untuk para entrepreneur muda.</small>
                    </div>
                    <div class="f">
                        <div class="fi"><svg class="i">
                                <use href="#i-trend" />
                            </svg></div><b>Kembangkan</b><small>Bersama wujudkan potensi bisnis mereka.</small>
                    </div>
                    <div class="f">
                        <div class="fi"><svg class="i">
                                <use href="#i-link" />
                            </svg></div><b>Terhubung</b><small>Bangun peluang dan kolaborasi lebih luas.</small>
                    </div>
                </div>
                <div class="card bdi">
                    <div class="bot">
                        <svg class="i">
                            <use href="#i-bot" />
                        </svg>
                    </div>

                    <div>
                        <b>Ada yang bisa dibantu, nih?</b>
                        <small>
                            Tanya langsung ke B-Di, Business Development Assistant!
                        </small>
                    </div>

                    <a href="{{ route('chatbot.page') }}" class="go">
                        <svg class="i">
                            <use href="#i-arr" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>


    {{-- TENTANG BD --}}

    <section class="sec" id="about">
        <div class="wrap">

            <div class="sh">
                <span class="si">
                    <x-i n="target" />
                </span>

                <div>
                    <h2>Tentang BD</h2>

                    <p>
                        {{ $settings['tagline'] ?? 'Kenali wadah yang menumbuhkan wirausaha muda mahasiswa.' }}
                    </p>
                </div>

                <a href="{{ route('about') }}">
                    Selengkapnya
                    <x-i n="arr" />
                </a>
            </div>


            <div class="vm">

                {{-- VISI --}}
                <div class="vcard">

                    <span class="sc">
                        Visi kami
                    </span>

                    <h2>
                        {{ $settings['vision'] ?? 'Menjadikan setiap ide kecil mahasiswa berdampak besar.' }}
                    </h2>

                    <p>
                        {{ $settings['about'] ?? 'Wadah yang menumbuhkan wirausaha muda, dari kampus untuk masyarakat luas.' }}
                    </p>

                    <a class="btn" href="{{ route('about') }}"
                        style="background:#fff;color:var(--pri);margin-top:20px">
                        Kenali BD
                        <x-i n="arr" />
                    </a>

                    <x-i n="sparkle" class="deco" />

                </div>


                {{-- NILAI / MISI --}}
                <div class="mis">

                    @foreach ([['bulb', 'Kreatif', 'Berani mencoba hal baru dan melihat peluang dari ide sederhana.'], ['users', 'Kolaboratif', 'Bertumbuh bersama lewat kerja sama lintas prodi dan komunitas.'], ['trend', 'Berdampak', 'Setiap karya diarahkan untuk memberi manfaat nyata.']] as [$i, $t, $d])
                        <div class="card mi">

                            <div class="fi">
                                <x-i :n="$i" />
                            </div>

                            <div>
                                <b>{{ $t }}</b>

                                <p>{{ $d }}</p>
                            </div>

                        </div>
                    @endforeach

                </div>

            </div>

        </div>
    </section>

    {{-- PRODUK (1 baris) --}}
    <section class="sec" id="products">
        <div class="wrap">
            <div class="sh"><span class="si"><x-i n="bag" /></span>
                <div>
                    <h2>Produk Pilihan</h2>
                    <p>Karya terbaru dari mahasiswa berbakat.</p>
                </div><a href="{{ route('products.index') }}">Lihat Semua <x-i n="arr" /></a>
            </div>
            <div class="row1">
                @foreach ($featuredProducts->take(5) as $p)
                    <x-product-card :p="$p" />
                @endforeach
            </div>
        </div>
    </section>

    {{-- KOLABORASI & KABAR --}}
    <section class="sec" id="collaborations">
        <div class="wrap">

            <div class="sh">
                <span class="si">
                    <x-i n="link" />
                </span>

                <div>
                    <h2>Kolaborasi &amp; Kabar</h2>
                    <p>
                        Informasi terbaru dan kolaborasi bersama Business Development.
                    </p>
                </div>

                <a href="{{ route('collaborations') }}">
                    Lihat Semua
                    <x-i n="arr" />
                </a>
            </div>


            <div class="home-collab-grid">

                {{-- =====================================================
    BERITA
====================================================== --}}
                @foreach ($news->take(2) as $item)
                    @php
                        $newsImageUrl = null;

                        if ($item->cover_image) {
                            $newsImage = $item->cover_image;

                            // URL lengkap
                            if (str_starts_with($newsImage, 'http://') || str_starts_with($newsImage, 'https://')) {
                                $newsImageUrl = $newsImage;

                                // Sudah berupa storage/...
                            } elseif (str_starts_with($newsImage, 'storage/')) {
                                $newsImageUrl = asset($newsImage);

                                // Berada di public/images/...
                            } elseif (str_starts_with($newsImage, 'images/')) {
                                $newsImageUrl = asset($newsImage);

                                // Hasil upload Laravel Storage
                            } else {
                                $newsImageUrl = asset('storage/' . ltrim($newsImage, '/'));
                            }
                        }
                    @endphp


                    <a href="{{ route('collaborations') }}" class="card home-collab-card">

                        {{-- FOTO BERITA --}}
                        <div class="home-collab-image">

                            @if ($newsImageUrl)
                                <img src="{{ $newsImageUrl }}" alt="{{ $item->title }}"
                                    onerror="
                        this.style.display='none';
                        this.nextElementSibling.style.display='flex';
                    ">

                                <div class="home-collab-placeholder" style="display:none;">
                                    <x-i n="users" />
                                </div>
                            @else
                                <div class="home-collab-placeholder">
                                    <x-i n="users" />
                                </div>
                            @endif

                        </div>


                        {{-- ISI BERITA --}}
                        <div class="home-collab-body">

                            <span class="pill">
                                <x-i n="users" />
                                Berita BD
                            </span>

                            <h3>
                                {{ $item->title }}
                            </h3>

                            <p>
                                {{ $item->excerpt }}
                            </p>

                            <div class="home-collab-bottom">

                                <span>
                                    <x-i n="cal" />

                                    {{ $item->published_at ? $item->published_at->format('d M Y') : '-' }}
                                </span>

                                <span class="home-collab-more">
                                    Baca selengkapnya
                                    <x-i n="arr" />
                                </span>

                            </div>

                        </div>

                    </a>
                @endforeach



                {{-- =====================================================
                KOLABORASI
            ====================================================== --}}
                @foreach ($collaborations->take(2) as $collaboration)
                    <a href="{{ route('collaborations') }}" class="card home-collab-card">

                        {{-- FOTO / LOGO --}}
                        <div class="home-collab-image collaboration-image">

                            @php
                                $logoUrl = null;

                                if ($collaboration->logo) {
                                    $logo = $collaboration->logo;

                                    if (str_starts_with($logo, 'http://') || str_starts_with($logo, 'https://')) {
                                        $logoUrl = $logo;
                                    } elseif (str_starts_with($logo, 'storage/')) {
                                        $logoUrl = asset($logo);
                                    } elseif (str_starts_with($logo, 'images/')) {
                                        $logoUrl = asset($logo);
                                    } else {
                                        $logoUrl = asset('storage/' . ltrim($logo, '/'));
                                    }
                                }
                            @endphp


                            @if ($logoUrl)
                                <img src="{{ $logoUrl }}" alt="{{ $collaboration->name }}"
                                    onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">

                                <div class="home-collab-placeholder" style="display:none;">
                                    <x-i n="users" />
                                </div>
                            @else
                                <div class="home-collab-placeholder">
                                    <x-i n="users" />
                                </div>
                            @endif

                        </div>


                        {{-- ISI --}}
                        <div class="home-collab-body">

                            <span class="pill">
                                <x-i n="link" />
                                Partner BD
                            </span>

                            <h3>
                                {{ $collaboration->name }}
                            </h3>

                            <p>
                                {{ $collaboration->description ?? 'Kolaborasi dan sinergi untuk mendukung perkembangan mahasiswa.' }}
                            </p>


                            <div class="home-collab-bottom">

                                <span>
                                    <x-i n="users" />
                                    Mitra Kolaborasi
                                </span>

                                <span class="home-collab-more">
                                    Lihat kolaborasi
                                    <x-i n="arr" />
                                </span>

                            </div>

                        </div>

                    </a>
                @endforeach



                {{-- KALAU KOSONG --}}
                @if ($news->count() === 0 && $collaborations->count() === 0)
                    <p style="color:var(--mut)">
                        Belum ada kabar atau kolaborasi yang ditampilkan.
                    </p>
                @endif

            </div>

        </div>
    </section>

    {{-- KONTAK --}}

    <div class="banner" id="contact">

        <div class="h">
            Your Idea<br>
            Our Support
        </div>

        <div class="b">
            <x-i n="bldg" />
        </div>

        <div class="pl">
            <x-i n="send" />
        </div>

        <h2>Punya Ide Bisnis?</h2>

        <p>
            Jangan ragu untuk bergabung bersama BD.<br>
            Wujudkan ide dan karyamu menjadi dampak nyata!
        </p>

        <div class="cta">
            <a href="{{ route('contact') }}" class="btn p">
                Hubungi Kami
                <x-i n="arr" />
            </a>

            <a href="{{ route('products.index') }}" class="btn o">
                Jelajahi Produk
            </a>
        </div>

    </div>
@endsection

{{-- =========================================================
    STYLE KHUSUS KOLABORASI & KABAR
========================================================= --}}
<style>
    /* GRID 4 CARD */
    .home-collab-grid {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 18px;
        margin-top: 24px;
    }


    /* CARD */
    .home-collab-card {
        display: flex;
        flex-direction: column;
        min-width: 0;
        overflow: hidden;
        text-decoration: none;
        color: inherit;
        border-radius: 20px;
        transition:
            transform .25s ease,
            box-shadow .25s ease;
    }


    .home-collab-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 16px 35px rgba(30, 90, 160, .10);
    }


    /* FOTO ATAS
       SEMUA CARD SAMA UKURAN */
    .home-collab-image {
        width: 100%;
        height: 145px;
        flex: 0 0 145px;
        background: #eaf2ff;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
    }


    /* FOTO NEWS */
    .home-collab-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }


    /* LOGO KOLABORASI
       TIDAK DI-CROP */
    .home-collab-image.collaboration-image img {
        width: 105px;
        height: 105px;
        object-fit: contain;
        border-radius: 14px;
    }


    /* PLACEHOLDER */
    .home-collab-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #8aa9d5;
    }


    .home-collab-placeholder svg {
        width: 38px;
        height: 38px;
    }


    /* ISI CARD */
    .home-collab-body {
        padding: 17px 17px 15px;
        display: flex;
        flex-direction: column;
        flex: 1;
        min-width: 0;
    }


    /* LABEL */
    .home-collab-body .pill {
        width: fit-content;
        margin-bottom: 10px;
    }


    /* JUDUL
       MAKSIMAL 2 BARIS */
    .home-collab-body h3 {
        margin: 0;
        color: var(--ink);
        font-size: 15px;
        line-height: 1.4;

        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;

        min-height: 42px;
    }


    /* DESKRIPSI
       MAKSIMAL 2 BARIS */
    .home-collab-body p {
        margin: 9px 0 0;
        color: var(--mut);
        font-size: 11.5px;
        line-height: 1.65;

        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;

        min-height: 38px;
    }


    /* BAGIAN BAWAH */
    .home-collab-bottom {
        margin-top: auto;
        padding-top: 16px;

        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 8px;

        color: var(--mut);
        font-size: 10.5px;
    }


    .home-collab-bottom>span {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        min-width: 0;
    }


    .home-collab-bottom svg {
        width: 13px;
        height: 13px;
        flex: 0 0 auto;
    }


    /* LINK BACA / LIHAT */
    .home-collab-more {
        color: var(--pri);
        font-weight: 700;
        white-space: nowrap;
        transition: gap .2s ease;
    }


    .home-collab-card:hover .home-collab-more {
        gap: 8px;
    }


    /* =====================================================
       TABLET
    ====================================================== */
    @media (max-width: 1100px) {

        .home-collab-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }

    }


    /* =====================================================
       HP
    ====================================================== */
    @media (max-width: 600px) {

        .home-collab-grid {
            grid-template-columns: 1fr;
            gap: 16px;
        }


        .home-collab-image {
            height: 170px;
            flex-basis: 170px;
        }


        .home-collab-body {
            padding: 16px;
        }

    }
</style>
