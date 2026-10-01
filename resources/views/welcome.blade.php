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


            <div class="news">

                {{-- BERITA --}}

                @foreach ($news->take(2) as $item)
                    <a href="{{ route('collaborations') }}" class="card nw">

                        <div class="ph"
                            @if ($item->cover_image) style="background-image:url('{{ asset($item->cover_image) }}'); background-size:cover; background-position:center;"
                        @else
                            style="background:#eaf2ff;" @endif>

                            @if (!$item->cover_image)
                                <x-i n="users" />
                            @endif

                        </div>


                        <div class="bd">

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

                            <div class="dt">

                                <span>
                                    <x-i n="cal" />

                                    {{ $item->published_at ? $item->published_at->format('d M Y') : '-' }}
                                </span>

                                <span class="go">
                                    <x-i n="arr" />
                                </span>

                            </div>

                        </div>

                    </a>
                @endforeach


                {{-- KOLABORASI --}}

                @foreach ($collaborations->take(2) as $collaboration)
                    <div class="card nw">

                        <div class="ph" style="background:#eaf2ff;">

                            @if ($collaboration->logo)
                                <img src="{{ asset($collaboration->logo) }}" alt="{{ $collaboration->name }}"
                                    style="
                                    width:80px;
                                    height:80px;
                                    object-fit:contain;
                                    border-radius:16px;
                                ">
                            @else
                                <x-i n="users" />
                            @endif

                        </div>


                        <div class="bd">

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

                            <div class="dt">

                                <span>
                                    <x-i n="users" />
                                    Mitra Kolaborasi
                                </span>

                                @if ($collaboration->link)
                                    <a class="go" href="{{ $collaboration->link }}" target="_blank" rel="noopener"
                                        aria-label="Kunjungi {{ $collaboration->name }}">
                                        <x-i n="arr" />
                                    </a>
                                @else
                                    <span class="go">
                                        <x-i n="arr" />
                                    </span>
                                @endif

                            </div>

                        </div>

                    </div>
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
