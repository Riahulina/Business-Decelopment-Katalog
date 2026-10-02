@extends('layouts.bd')

@section('title', 'Masuk')

@section('content')

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

                    <span class="sc">Selamat datang kembali</span>

                    <h1>Masuk ke BD Student Katalog</h1>

                    <p>Wadah ide, karya, dan kolaborasi mahasiswa. Masuk untuk mengelola produk dan perkembanganmu.</p>

                    <ul class="auth-points">
                        <li>
                            <span><x-i n="bulb" /></span>
                            Kelola produk dan profil penjualmu
                        </li>
                        <li>
                            <span><x-i n="trend" /></span>
                            Pantau perkembangan lewat dashboard
                        </li>
                        <li>
                            <span><x-i n="users" /></span>
                            Terhubung dengan komunitas dan HMPS
                        </li>
                    </ul>

                    <svg class="deco" viewBox="0 0 40 40" fill="currentColor" aria-hidden="true">
                        <path d="M20 2l4 12 12-4-8 10 8 10-12-4-4 12-4-12-12 4 8-10-8-10 12 4z" />
                    </svg>

                </div>


                {{-- ============ PANEL KANAN: FORM ============ --}}
                <div class="auth-form">

                    <div class="auth-head">
                        <h2>Masuk</h2>
                        <p>Gunakan akun yang sudah terdaftar.</p>
                    </div>

                    @if (session('status'))
                        <div class="auth-alert ok" role="status">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}" novalidate>
                        @csrf

                        {{-- EMAIL --}}
                        <div class="auth-fld">
                            <label for="email">Email</label>

                            <div class="auth-input">
                                <x-i n="mail" />

                                <input id="email" type="email" name="email" value="{{ old('email') }}" required
                                    autofocus autocomplete="username" placeholder="nama@email.com"
                                    class="{{ $errors->has('email') ? 'is-invalid' : '' }}"
                                    aria-invalid="{{ $errors->has('email') ? 'true' : 'false' }}">
                            </div>

                            @error('email')
                                <p class="auth-error">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- PASSWORD --}}
                        <div class="auth-fld">
                            <label for="password">Password</label>

                            <div class="auth-input">
                                <svg class="i" viewBox="0 0 24 24">
                                    <rect x="5" y="11" width="14" height="9" rx="2" />
                                    <path d="M8 11V8a4 4 0 018 0v3" />
                                </svg>

                                <input id="password" type="password" name="password" required
                                    autocomplete="current-password" placeholder="Masukkan password"
                                    class="{{ $errors->has('password') ? 'is-invalid' : '' }}">

                                <button type="button" class="toggle" id="togglePw" aria-label="Tampilkan password">
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

                            @error('password')
                                <p class="auth-error">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- INGAT SAYA + LUPA PASSWORD --}}
                        <div class="auth-row">
                            <label class="auth-check" for="remember_me">
                                <input id="remember_me" type="checkbox" name="remember">
                                <span>Ingat saya</span>
                            </label>

                        </div>

                        <button type="submit" class="btn p auth-submit">
                            Masuk
                            <x-i n="arr" />
                        </button>
                    </form>

                    @if (Route::has('register'))
                        <p class="auth-foot">
                            Belum punya akun?
                            <a class="auth-link" href="{{ route('register') }}">Daftar sekarang</a>
                        </p>
                    @endif

                </div>

            </div>

        </div>
    </section>

    @push('scripts')
        <script>
            const pw = document.getElementById('password');
            const tg = document.getElementById('togglePw');

            tg?.addEventListener('click', () => {
                const show = pw.type === 'password';

                pw.type = show ? 'text' : 'password';
                tg.querySelector('.eye-on').hidden = show;
                tg.querySelector('.eye-off').hidden = !show;
                tg.setAttribute('aria-label', show ? 'Sembunyikan password' : 'Tampilkan password');
            });
        </script>
    @endpush

@endsection
