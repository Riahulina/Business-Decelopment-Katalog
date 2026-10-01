@extends('layouts.bd')

@section('title', 'Tentang BD')

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

    <section class="sec">

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

                <div class="lg">

                    <div class="lgbox">

                        @if (file_exists(public_path('img/logo-bd.png')))
                            <img src="{{ asset('img/logo-bd.png') }}" alt="Logo BD">
                        @else
                            <svg class="star" viewBox="0 0 40 40" fill="currentColor" style="color:var(--acc)">
                                <path d="M20 2l4 12 12-4-8 10 8 10-12-4-4 12-4-12-12 4 8-10-8-10 12 4z" />
                            </svg>
                        @endif

                    </div>

                    <b>Business Development</b>

                    <small>
                        Unit yang mewadahi dan mengembangkan bisnis mahasiswa.
                    </small>

                </div>


                <div class="x">×</div>


                <div class="lg">

                    <div class="lgbox">

                        @if (file_exists(public_path('img/logo-hmps.png')))
                            <img src="{{ asset('img/logo-hmps.png') }}" alt="Logo HMPS">
                        @else
                            Logo HMPS
                        @endif

                    </div>

                    <b>HMPS</b>

                    <small>
                        Himpunan Mahasiswa Program Studi, mitra utama BD.
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

    <section class="sec" style="padding-bottom:60px">

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
                        'period' => $settings['timeline_1_period'] ?? '',
                        'title' => $settings['timeline_1_title'] ?? '',
                        'description' => $settings['timeline_1_description'] ?? '',
                    ],
                    [
                        'period' => $settings['timeline_2_period'] ?? '',
                        'title' => $settings['timeline_2_title'] ?? '',
                        'description' => $settings['timeline_2_description'] ?? '',
                    ],
                    [
                        'period' => $settings['timeline_3_period'] ?? '',
                        'title' => $settings['timeline_3_title'] ?? '',
                        'description' => $settings['timeline_3_description'] ?? '',
                    ],
                    [
                        'period' => $settings['timeline_4_period'] ?? '',
                        'title' => $settings['timeline_4_title'] ?? '',
                        'description' => $settings['timeline_4_description'] ?? '',
                    ],
                ];
            @endphp


            <div class="tl">

                @foreach ($timeline as $item)
                    <div class="ts">

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
