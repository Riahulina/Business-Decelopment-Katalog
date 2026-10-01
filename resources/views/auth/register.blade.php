@extends('layouts.bd')

@section('title', 'Daftar')

@section('content')

    @php
        // Kolom password (dibuat dari array supaya tidak ditulis dua kali)
        $passwordFields = [
            [
                'id' => 'password',
                'label' => 'Password',
                'placeholder' => 'Minimal 8 karakter',
            ],
            [
                'id' => 'password_confirmation',
                'label' => 'Konfirmasi password',
                'placeholder' => 'Ulangi password',
            ],
        ];
    @endphp

    <section class="auth">
        <div class="wrap">

            <div class="auth-box card">

                {{-- ============ PANEL KIRI: BRAND ============ --}}
                <div class="auth-brand">

                    <a href="{{ route('home') }}" class="auth-logo" aria-label="Kembali ke beranda">
                        <svg class="star" viewBox="0 0 40 40" fill="currentColor">
                            <path d="M20 2l4 12 12-4-8 10 8 10-12-4-4 12-4-12-12 4 8-10-8-10 12 4z" />
                        </svg>
                        <b>BD</b>
                    </a>

                    <span class="sc">Mulai bersama kami</span>

                    <h1>Buat akun BD Student Marketplace</h1>

                    <p>Gabung dan tumbuh bersama ekosistem bisnis mahasiswa. Daftar dalam hitungan menit.</p>

                    <ul class="auth-points">
                        <li>
                            <span><x-i n="bulb" /></span>
                            Pasarkan produk kreatifmu
                        </li>
                        <li>
                            <span><x-i n="users" /></span>
                            Dapatkan dukungan komunitas dan HMPS
                        </li>
                        <li>
                            <span><x-i n="trend" /></span>
                            Kembangkan bisnismu bersama BD
                        </li>
                    </ul>

                    <svg class="deco" viewBox="0 0 40 40" fill="currentColor" aria-hidden="true">
                        <path d="M20 2l4 12 12-4-8 10 8 10-12-4-4 12-4-12-12 4 8-10-8-10 12 4z" />
                    </svg>

                </div>


                {{-- ============ PANEL KANAN: FORM ============ --}}
                <div class="auth-form">

                    <div class="auth-head">
                        <h2>Daftar</h2>
                        <p>Isi data di bawah untuk membuat akun baru.</p>
                    </div>

                    <form method="POST" action="{{ route('register') }}" novalidate>
                        @csrf

                        {{-- NAMA --}}
                        <div class="auth-fld">
                            <label for="name">Nama lengkap</label>

                            <div class="auth-input">
                                <x-i n="user" />

                                <input id="name" type="text" name="name" value="{{ old('name') }}" required
                                    autofocus autocomplete="name" placeholder="Nama kamu"
                                    class="{{ $errors->has('name') ? 'is-invalid' : '' }}">
                            </div>

                            @error('name')
                                <p class="auth-error">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- EMAIL --}}
                        <div class="auth-fld">
                            <label for="email">Email</label>

                            <div class="auth-input">
                                <x-i n="mail" />

                                <input id="email" type="email" name="email" value="{{ old('email') }}" required
                                    autocomplete="username" placeholder="nama@email.com"
                                    class="{{ $errors->has('email') ? 'is-invalid' : '' }}">
                            </div>

                            @error('email')
                                <p class="auth-error">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- PASSWORD + KONFIRMASI --}}
                        @foreach ($passwordFields as $f)
                            <div class="auth-fld">
                                <label for="{{ $f['id'] }}">{{ $f['label'] }}</label>

                                <div class="auth-input">
                                    <svg class="i" viewBox="0 0 24 24">
                                        <rect x="5" y="11" width="14" height="9" rx="2" />
                                        <path d="M8 11V8a4 4 0 018 0v3" />
                                    </svg>

                                    <input id="{{ $f['id'] }}" type="password" name="{{ $f['id'] }}" required
                                        autocomplete="new-password" placeholder="{{ $f['placeholder'] }}"
                                        class="has-toggle {{ $errors->has($f['id']) ? 'is-invalid' : '' }}">

                                    <button type="button" class="toggle" data-toggle="{{ $f['id'] }}"
                                        aria-label="Tampilkan password">
                                        <svg class="i eye-on" viewBox="0 0 24 24">
                                            <path d="M2 12s4-7 10-7 10 7 10 7-4 7-10 7S2 12 2 12z" />
                                            <circle cx="12" cy="12" r="3" />
                                        </svg>

                                        <svg class="i eye-off" viewBox="0 0 24 24" hidden>
                                            <path d="M3 3l18 18" />
                                            <path
                                                d="M10.6 5.1A10 10 0 0112 5c6 0 10 7 10 7a17 17 0 01-3.2 3.9M6.5 6.6C3.8 8.4 2 12 2 12s4 7 10 7a9.7 9.7 0 004.1-.9" />
                                            <path d="M9.9 9.9a3 3 0 004.2 4.2" />
                                        </svg>
                                    </button>
                                </div>

                                @error($f['id'])
                                    <p class="auth-error">{{ $message }}</p>
                                @enderror
                            </div>
                        @endforeach

                        <button type="submit" class="btn p auth-submit" style="margin-top:6px">
                            Buat Akun
                            <x-i n="arr" />
                        </button>
                    </form>

                    <p class="auth-foot">
                        Sudah punya akun?
                        <a class="auth-link" href="{{ route('login') }}">Masuk</a>
                    </p>

                </div>

            </div>

        </div>
    </section>

    @push('scripts')
        <script>
            document.querySelectorAll('[data-toggle]').forEach(btn => {
                btn.addEventListener('click', () => {
                    const input = document.getElementById(btn.dataset.toggle);
                    const show = input.type === 'password';

                    input.type = show ? 'text' : 'password';
                    btn.querySelector('.eye-on').hidden = show;
                    btn.querySelector('.eye-off').hidden = !show;
                    btn.setAttribute('aria-label', show ? 'Sembunyikan password' : 'Tampilkan password');
                });
            });
        </script>
    @endpush

@endsection
