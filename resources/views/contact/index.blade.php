@extends('layouts.bd')

@section('title', 'Kontak')

@section('content')

    <x-page-banner eyebrow="Contact BD" title="Wadah Ide, Karya, dan Kolaborasi Mahasiswa" />

    @php
        // ====== GANTI DENGAN NOMOR ADMIN ======
        $wa = '6289508721206'; // format 62..., tanpa + dan tanpa spasi
        $waLabel = '+62 895-0872-1206'; // tampilan di halaman
        // ======================================

        $waLink = fn(string $text) => 'https://wa.me/' . $wa . '?text=' . rawurlencode($text);

        $topics = [
            [
                'icon' => 'trend',
                'title' => 'Bergabung sebagai penjual',
                'desc' => 'Mau memasarkan produk kreatifmu di BD.',
                'text' => 'Halo admin BD, saya ingin bergabung sebagai penjual di BD Student Marketplace.',
            ],
            [
                'icon' => 'users',
                'title' => 'Kolaborasi dan kemitraan',
                'desc' => 'Untuk HMPS, komunitas, atau mitra yang ingin bekerja sama.',
                'text' => 'Halo admin BD, saya ingin membahas kolaborasi dan kemitraan dengan BD.',
            ],
            [
                'icon' => 'chat',
                'title' => 'Pertanyaan umum',
                'desc' => 'Tanya apa saja seputar BD dan produk mahasiswa.',
                'text' => 'Halo admin BD, saya ingin bertanya tentang BD.',
            ],
        ];

        $contacts = [
            // GANTI akun Instagram HMPS di bawah ini
            [
                'icon' => 'cam',
                'label' => 'Instagram HMPS',
                'value' => '@HMPS MANAJEMEN INFORMATIKA POLMED',
                'href' => 'https://www.instagram.com/hmps.mi?stkn=MXJybmlzd3U2YzByeQ==',
            ],
            [
                'icon' => 'cam',
                'label' => 'Instagram BD',
                'value' => '@BD HMPS MI POLMED',
                'href' => 'https://www.instagram.com/bussinessdevelopmentmi?stkn=M2dud3E5Y2N1eGR1',
            ],
            ['icon' => 'pin', 'label' => 'Sekretariat', 'value' => 'Gedung Kemahasiswaan, Lantai 2', 'href' => null],
        ];
    @endphp

    <section class="sec contact-section">
        <div class="wrap">

            <div class="ct-hero">

                {{-- KARTU UTAMA: CHAT ADMIN --}}
                <div class="vcard ct-card">

                    <span class="sc">Hubungi kami</span>

                    <h2>Ngobrol langsung dengan admin BD lewat WhatsApp</h2>

                    <p>
                        Tanpa form yang ribet. Pilih keperluanmu, kirim chat, dan tim BD akan membalas langsung.
                    </p>

                    <ul class="ct-steps">
                        <li><b>1</b> Pilih keperluan</li>
                        <li><b>2</b> Chat WhatsApp</li>
                        <li><b>3</b> Dibalas admin</li>
                    </ul>

                    <a class="btn wa" href="{{ $waLink('Halo admin BD, saya ingin bertanya.') }}" target="_blank"
                        rel="noopener">
                        <svg class="i" viewBox="0 0 24 24">
                            <path d="M3 21l1.7-5A9 9 0 1 1 8 19.3L3 21z" />
                            <path d="M9 9.5c.3 2 2.5 4.2 4.5 4.5l1.3-1.3-2-1-.8.8c-1-.4-1.8-1.2-2.2-2.2l.8-.8-1-2L9 9.5z" />
                        </svg>
                        Chat Admin via WhatsApp
                    </a>

                    <span class="ct-num">{{ $waLabel }}</span>

                    <svg class="i deco" viewBox="0 0 24 24">
                        <path d="M3 21l1.7-5A9 9 0 1 1 8 19.3L3 21z" />
                        <path d="M9 9.5c.3 2 2.5 4.2 4.5 4.5l1.3-1.3-2-1-.8.8c-1-.4-1.8-1.2-2.2-2.2l.8-.8-1-2L9 9.5z" />
                    </svg>

                </div>


                {{-- PILIH KEPERLUAN --}}
                <div class="ct-side">

                    <div class="ct-side-head">
                        <h3>Mau bahas apa?</h3>
                        <p>Pilih salah satu, pesan awalnya langsung terisi di WhatsApp.</p>
                    </div>

                    @foreach ($topics as $topic)
                        <a class="card ct-topic" href="{{ $waLink($topic['text']) }}" target="_blank" rel="noopener">

                            <span class="ico">
                                <x-i :n="$topic['icon']" />
                            </span>

                            <span class="tx">
                                <b>{{ $topic['title'] }}</b>
                                <small>{{ $topic['desc'] }}</small>
                            </span>

                            <span class="go">
                                <x-i n="arr" />
                            </span>

                        </a>
                    @endforeach

                </div>

            </div>


            {{-- INFO KONTAK LAIN --}}
            <div class="ct-info">
                @foreach ($contacts as $c)
                    @php $tag = $c['href'] ? 'a' : 'div'; @endphp

                    <{{ $tag }} class="card contact-item"
                        @if ($c['href']) href="{{ $c['href'] }}" @endif
                        @if ($c['href'] && str_starts_with($c['href'], 'http')) target="_blank" rel="noopener" @endif>

                        <div class="contact-item-icon">
                            <x-i :n="$c['icon']" />
                        </div>

                        <div class="contact-item-content">
                            <span>{{ $c['label'] }}</span>
                            <h3>{{ $c['value'] }}</h3>
                        </div>

                        @if ($c['href'])
                            <span class="contact-arrow"><x-i n="arr" /></span>
                        @endif

                        </{{ $tag }}>
                @endforeach
            </div>

        </div>
    </section>

@endsection
