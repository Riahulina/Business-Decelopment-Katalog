@extends('layouts.bd')

@section('title', 'Kolaborasi & Kabar Terbaru')

@section('content')

    <x-page-banner eyebrow="Berita & Kolaborasi BD" title="Wadah Ide, Karya, dan Kolaborasi Mahasiswa" />

    {{-- ================================
     KOLABORASI
================================= --}}

    <section class="sec">
        <div class="wrap">

            <div class="sh">
                <span class="si">
                    <x-i n="users" />
                </span>

                <div>
                    <h2>Dibangun Bersama</h2>
                    <p>Kolaborasi BD dengan berbagai HMPS dan komunitas.</p>
                </div>
            </div>

            @if ($collaborations->count())

                <div class="kol">

                    {{-- DETAIL KOLABORASI --}}
                    <div class="card kf">

                        @foreach ($collaborations as $index => $collaboration)
                            <div class="collab-detail {{ $index === 0 ? 'active' : '' }}" data-detail="{{ $index }}">

                                <div class="bt">

                                    <div class="ph">
                                        <x-i n="users" />

                                        @if ($collaboration->logo_url)
                                            <img src="{{ $collaboration->logo_url }}" alt="{{ $collaboration->name }}"
                                                onerror="this.remove()">
                                        @endif
                                    </div>

                                    <div>

                                        <span class="pill">
                                            <x-i n="users" />
                                            Kolaborasi Utama
                                        </span>

                                        <h4>
                                            {{ $collaboration->name }}
                                        </h4>

                                        <p>
                                            {{ $collaboration->description }}
                                        </p>

                                    </div>

                                </div>

                            </div>
                        @endforeach

                    </div>


                    {{-- LIST KOLABORASI --}}
                    <div class="side">

                        @foreach ($collaborations as $index => $collaboration)
                            <button type="button" class="card kc collab-select {{ $index === 0 ? 'active' : '' }}"
                                data-target="{{ $index }}">

                                <span class="pill">
                                    <x-i n="link" />
                                    Kemitraan
                                </span>

                                <h4>
                                    {{ $collaboration->name }}
                                </h4>

                                @if ($collaboration->description)
                                    <p>
                                        {{ \Illuminate\Support\Str::limit($collaboration->description, 90) }}
                                    </p>
                                @endif

                                <div class="dt">
                                    <span>
                                        Lihat kolaborasi
                                    </span>

                                    <span class="go">
                                        <x-i n="arr" />
                                    </span>
                                </div>

                            </button>
                        @endforeach

                    </div>

                </div>
            @else
                <div class="card" style="padding:30px;text-align:center;">
                    <x-i n="users" />
                    <h3>Belum ada kolaborasi</h3>
                    <p>Informasi kolaborasi akan ditampilkan di sini.</p>
                </div>

            @endif

        </div>
    </section>

    {{-- ================================
         KABAR TERBARU
    ================================= --}}
    <section class="sec" id="kabar" style="padding-bottom:60px">

        <div class="wrap">

            <div class="sh">
                <span class="si">
                    <x-i n="sparkle" />
                </span>

                <div>
                    <h2>Kabar Terbaru BD</h2>
                    <p>
                        Berita, acara, dan peluang terbaru dari ekosistem bisnis mahasiswa.
                    </p>
                </div>
            </div>


            @if ($news->count())

                @foreach ($news as $index => $item)
                    @php
                        $date = optional($item->published_at)->locale('id')->translatedFormat('d F Y');
                        $others = $news->where('id', '!=', $item->id);
                    @endphp

                    <div class="nd-item {{ $index === 0 ? 'active' : '' }}" data-news="{{ $item->slug }}">
                        <div class="nd">

                            {{-- ============ KIRI: ARTIKEL ============ --}}
                            <article class="nd-main">

                                <div class="nd-top">

                                    <div>
                                        <span class="pill">{{ $item->category }}</span>

                                        <h3 class="nd-title">{{ $item->title }}</h3>

                                        <p class="nd-lead">{{ $item->excerpt }}</p>

                                        <div class="nd-meta">
                                            <span>
                                                <x-i n="cal" />
                                                {{ $date }}
                                            </span>

                                            <span>
                                                <svg class="i" viewBox="0 0 24 24">
                                                    <circle cx="12" cy="12" r="9" />
                                                    <path d="M12 7v5l3 2" />
                                                </svg>
                                                {{ $item->reading_time }} menit baca
                                            </span>

                                            <button type="button" data-share="{{ $item->slug }}"
                                                data-title="{{ $item->title }}">
                                                <svg class="i" viewBox="0 0 24 24">
                                                    <circle cx="18" cy="5" r="3" />
                                                    <circle cx="6" cy="12" r="3" />
                                                    <circle cx="18" cy="19" r="3" />
                                                    <path d="M8.6 10.5l6.8-4M8.6 13.5l6.8 4" />
                                                </svg>
                                                Bagikan
                                            </button>
                                        </div>
                                    </div>

                                    <div class="nd-cover">
                                        <x-i n="sparkle" />

                                        @if ($item->cover_url)
                                            <img src="{{ $item->cover_url }}" alt="{{ $item->title }}"
                                                onerror="this.remove()">
                                        @endif
                                    </div>

                                </div>

                                <div class="nd-body">
                                    {!! $item->content_html !!}
                                </div>

                                @if ($item->quote)
                                    <blockquote class="nd-quote">
                                        <div>
                                            <p>{{ $item->quote }}</p>

                                            @if ($item->quote_author)
                                                <small>— {{ $item->quote_author }}</small>
                                            @endif
                                        </div>
                                    </blockquote>
                                @endif

                            </article>


                            {{-- ============ KANAN: INFO + TERKAIT ============ --}}
                            <aside class="nd-side">

                                <div class="card nd-card">
                                    <h3>Informasi Penting</h3>

                                    <ul class="nd-info">
                                        <li>
                                            <span class="fi">
                                                <svg class="i" viewBox="0 0 24 24">
                                                    <path d="M3 12V4h8l10 10-8 8L3 12z" />
                                                    <circle cx="7.5" cy="8.5" r="1.2" />
                                                </svg>
                                            </span>
                                            <div>
                                                <small>Kategori</small>
                                                <b>{{ $item->category }}</b>
                                            </div>
                                        </li>

                                        <li>
                                            <span class="fi"><x-i n="cal" /></span>
                                            <div>
                                                <small>Tanggal</small>
                                                <b>{{ $date }}</b>
                                            </div>
                                        </li>

                                        <li>
                                            <span class="fi">
                                                <svg class="i" viewBox="0 0 24 24">
                                                    <path d="M12 21s7-6.2 7-11a7 7 0 10-14 0c0 4.8 7 11 7 11z" />
                                                    <circle cx="12" cy="10" r="2.5" />
                                                </svg>
                                            </span>
                                            <div>
                                                <small>Media</small>
                                                <b>{{ $item->source }}</b>
                                            </div>
                                        </li>

                                        @if ($item->attachment_url)
                                            <li>
                                                <span class="fi"><x-i n="link" /></span>
                                                <div>
                                                    <small>Unduhan</small>
                                                    <a class="nd-dl" href="{{ $item->attachment_url }}" target="_blank"
                                                        rel="noopener">
                                                        Lihat Lampiran
                                                        <svg class="i" viewBox="0 0 24 24">
                                                            <path d="M12 4v11M7 11l5 5 5-5M5 20h14" />
                                                        </svg>
                                                    </a>
                                                </div>
                                            </li>
                                        @endif
                                    </ul>
                                </div>

                                @if ($others->count())
                                    <div class="card nd-card">
                                        <h3>Artikel Terkait</h3>

                                        <div class="nd-rel">
                                            @foreach ($others as $other)
                                                <button type="button" data-news-target="{{ $other->slug }}">
                                                    <span class="th">
                                                        <x-i n="sparkle" />

                                                        @if ($other->cover_url)
                                                            <img src="{{ $other->cover_url }}" alt="{{ $other->title }}"
                                                                loading="lazy" onerror="this.remove()">
                                                        @endif
                                                    </span>

                                                    <span class="tx">
                                                        <b>{{ $other->title }}</b>
                                                        <small>
                                                            <x-i n="cal" />
                                                            {{ optional($other->published_at)->locale('id')->translatedFormat('d F Y') }}
                                                        </small>
                                                    </span>

                                                    <span class="go"><x-i n="arr" /></span>
                                                </button>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                            </aside>
                        </div>
                    </div>
                @endforeach


                {{-- ============ STRIP PRODUK ============ --}}
                @if ($products->count())
                    <div class="nd-strip">

                        <div class="tt">Jelajahi Produk<br>Lainnya</div>

                        <div class="row">
                            @foreach ($products as $product)
                                <a class="nd-mini" href="{{ $product['url'] }}">
                                    <span class="th">
                                        <x-i n="sparkle" />

                                        @if ($product['image'])
                                            <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}"
                                                loading="lazy" onerror="this.remove()">
                                        @endif
                                    </span>

                                    <span class="tx">
                                        <b>{{ $product['name'] }}</b>
                                        <small>Rp {{ number_format($product['price'], 0, ',', '.') }}</small>
                                    </span>

                                    <span class="go"><x-i n="arr" /></span>
                                </a>
                            @endforeach
                        </div>

                        <a class="btn o" href="{{ url('/produk') }}">
                            Lihat Semua Produk
                            <x-i n="arr" />
                        </a>

                    </div>
                @endif
            @else
                <div class="card" style="padding:30px;text-align:center;">
                    <x-i n="sparkle" />
                    <h3>Belum ada kabar terbaru</h3>
                    <p>Berita dan informasi BD akan ditampilkan di sini.</p>
                </div>

            @endif

        </div>

    </section>

    @push('scripts')
        <script>
            /* ---------- Kolaborasi: ganti detail ---------- */
            document.querySelectorAll('.collab-select').forEach(button => {

                button.addEventListener('click', function() {

                    const target = this.dataset.target;

                    document.querySelectorAll('.collab-select').forEach(item => {
                        item.classList.remove('active');
                    });

                    this.classList.add('active');

                    document.querySelectorAll('.collab-detail').forEach(detail => {
                        detail.classList.remove('active');
                    });

                    const detail = document.querySelector(
                        `.collab-detail[data-detail="${target}"]`
                    );

                    if (detail) {
                        detail.classList.add('active');
                    }

                });

            });


            /* ---------- Kabar: ganti artikel ---------- */
            const newsItems = document.querySelectorAll('.nd-item');

            function showNews(slug) {
                let found = false;

                newsItems.forEach(el => {
                    const on = el.dataset.news === slug;
                    el.classList.toggle('active', on);
                    if (on) found = true;
                });

                if (found) {
                    history.replaceState(null, '', '#kabar-' + slug);
                }

                return found;
            }

            document.querySelectorAll('[data-news-target]').forEach(btn => {
                btn.addEventListener('click', () => {
                    if (showNews(btn.dataset.newsTarget)) {
                        document.getElementById('kabar').scrollIntoView({
                            behavior: 'smooth'
                        });
                    }
                });
            });

            /* Bagikan: salin link ke artikel yang sedang dibuka */
            document.querySelectorAll('[data-share]').forEach(btn => {
                btn.addEventListener('click', async () => {
                    const url = location.origin + location.pathname + '#kabar-' + btn.dataset.share;

                    try {
                        if (navigator.share) {
                            await navigator.share({
                                title: btn.dataset.title,
                                url
                            });
                            return;
                        }

                        await navigator.clipboard.writeText(url);

                        if (typeof toast === 'function') toast('Link berhasil disalin');
                    } catch (e) {}
                });
            });

            /* Buka langsung ke artikel kalau URL berisi #kabar-slug */
            if (location.hash.startsWith('#kabar-')) {
                const slug = decodeURIComponent(location.hash.slice(7));

                if (showNews(slug)) {
                    window.addEventListener('load', () => {
                        document.getElementById('kabar').scrollIntoView();
                    });
                }
            }
        </script>
    @endpush

@endsection
