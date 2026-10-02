@extends('layouts.bd')

@section('title', 'Tentang BD')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/about.css') }}">
@endpush

@section('content')

    <x-page-banner eyebrow="ABOUT BD" title="Wadah Ide, Karya, dan Kolaborasi Mahasiswa" />

    {{-- ================================
         VISI & MISI
    ================================= --}}
    <section class="sec">
        <div class="wrap">

            <div class="sh">
                <span class="si">
                    <x-i n="target" />
                </span>

                <div>
                    <h2>Visi &amp; Misi</h2>
                    <p>Arah yang kami tuju dan langkah untuk mencapainya.</p>
                </div>
            </div>

            <div class="vm">

                {{-- VISI --}}
                <div class="vcard">
                    <span class="sc">Visi kami</span>

                    <h2>
                        {{ $settings['about_vision_title'] ?? ($settings['vision'] ?? '') }}
                    </h2>

                    <p>
                        {{ $settings['about_vision_description'] ?? '' }}
                    </p>

                    <x-i n="sparkle" class="deco" />
                </div>

                {{-- MISI --}}
                <div class="mis">

                    @php
                        $missions = [
                            [
                                'icon' => 'bag',
                                'title' => $settings['mission_1_title'] ?? '',
                                'description' => $settings['mission_1_description'] ?? '',
                            ],
                            [
                                'icon' => 'users',
                                'title' => $settings['mission_2_title'] ?? '',
                                'description' => $settings['mission_2_description'] ?? '',
                            ],
                            [
                                'icon' => 'link',
                                'title' => $settings['mission_3_title'] ?? '',
                                'description' => $settings['mission_3_description'] ?? '',
                            ],
                            [
                                'icon' => 'trend',
                                'title' => $settings['mission_4_title'] ?? '',
                                'description' => $settings['mission_4_description'] ?? '',
                            ],
                        ];
                    @endphp

                    @foreach ($missions as $mission)
                        <div class="card mi">
                            <div class="fi">
                                <x-i :n="$mission['icon']" />
                            </div>

                            <div>
                                <b>{{ $mission['title'] }}</b>
                                <p>{{ $mission['description'] }}</p>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>

        </div>
    </section>


    {{-- ================================
         DI BALIK BD
    ================================= --}}
    <section class="sec about-bd-section">

        <div class="wrap">

            <div class="sh">
                <span class="si">
                    <x-i n="users" />
                </span>

                <div>
                    <h2>Di Balik BD</h2>
                    <p>
                        BD tumbuh berkat dukungan dan kolaborasi bersama HMPS.
                    </p>
                </div>
            </div>


            <div class="card logos">

                {{-- BUSINESS DEVELOPMENT --}}
                <div class="lg">

                    <div class="lgbox logo-bd">
                        <img src="{{ asset('images/logobd.png') }}" alt="Logo Business Development">
                    </div>

                    <b>Business Development</b>

                    <small>
                        Divisi yang mewadahi dan mengembangkan bisnis mahasiswa.
                    </small>

                </div>


                {{-- CONNECTOR --}}
                <div class="connector" aria-hidden="true">
                    <span></span>
                    <i>×</i>
                    <span></span>
                </div>


                {{-- HMPS --}}
                <div class="lg">

                    <div class="lgbox logo-hmps">
                        <img src="{{ asset('images/logohmpes.jpeg') }}" alt="Logo HMPS">
                    </div>

                    <b>HMPS</b>

                    <small>
                        Himpunan Mahasiswa Program Studi Manajemen Informatika
                    </small>

                </div>

            </div>

        </div>

    </section>


    {{-- ================================
         NILAI
    ================================= --}}
    <section class="sec">

        <div class="wrap">

            <div class="sh">
                <span class="si">
                    <x-i n="flame" />
                </span>

                <div>
                    <h2>Nilai yang Kami Pegang</h2>
                    <p>Prinsip yang menjaga langkah BD tetap searah.</p>
                </div>
            </div>


            @php
                $values = [
                    [
                        'icon' => 'bulb',
                        'title' => $settings['value_1_title'] ?? '',
                        'description' => $settings['value_1_description'] ?? '',
                    ],
                    [
                        'icon' => 'users',
                        'title' => $settings['value_2_title'] ?? '',
                        'description' => $settings['value_2_description'] ?? '',
                    ],
                    [
                        'icon' => 'trend',
                        'title' => $settings['value_3_title'] ?? '',
                        'description' => $settings['value_3_description'] ?? '',
                    ],
                    [
                        'icon' => 'check',
                        'title' => $settings['value_4_title'] ?? '',
                        'description' => $settings['value_4_description'] ?? '',
                    ],
                ];
            @endphp


            <div class="val">

                @foreach ($values as $value)
                    <div class="card">

                        <div class="fi">
                            <x-i :n="$value['icon']" />
                        </div>

                        <b>{{ $value['title'] }}</b>

                        <p>
                            {{ $value['description'] }}
                        </p>

                    </div>
                @endforeach

            </div>

        </div>

    </section>


    {{-- ================================
         PERJALANAN BD
    ================================= --}}
    <section class="sec bd-timeline-section">

        <div class="wrap">

            <div class="sh">

                <span class="si">
                    <x-i n="trend" />
                </span>

                <div>
                    <h2>Perjalanan BD</h2>

                    <p>
                        Langkah demi langkah menuju ekosistem bisnis mahasiswa.
                    </p>
                </div>

            </div>


            @php
                $timeline = [
                    [
                        'period' => '2025',
                        'title' => 'Awal Berdirinya BD',
                        'description' =>
                            'Business Development pertama kali dibentuk sebagai wadah untuk mendukung dan mengembangkan potensi bisnis mahasiswa.',
                    ],
                    [
                        'period' => '2026',
                        'title' => 'Periode Kedua BD',
                        'description' =>
                            'Memasuki periode kedua, BD melanjutkan pengembangan program dan kolaborasi untuk mendukung mahasiswa dalam bidang bisnis dan kewirausahaan.',
                    ],
                    [
                        'period' => 'Oktober 2026',
                        'title' => 'Website Resmi BD Diluncurkan',
                        'description' =>
                            'Website resmi Business Development diluncurkan sebagai media informasi, publikasi produk, kolaborasi, dan akses layanan BD.',
                    ],
                ];
            @endphp


            <div class="tl">

                @foreach ($timeline as $item)
                    <div class="ts">

                        <span class="timeline-dot"></span>

                        <small>
                            {{ $item['period'] }}
                        </small>

                        <b>
                            {{ $item['title'] }}
                        </b>

                        <p>
                            {{ $item['description'] }}
                        </p>

                    </div>
                @endforeach

            </div>

        </div>

    </section>

@endsection
