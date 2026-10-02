@extends('layouts.bd')

@section('title', 'Ubah Password')

@section('content')

    <section class="auth">
        <div class="wrap">

            <div class="auth-box card">

                {{-- PANEL KIRI --}}
                <div class="auth-brand">

                    <a href="{{ route('home') }}" class="auth-logo" aria-label="Kembali ke beranda">
                        <svg class="star" viewBox="0 0 40 40" fill="currentColor">
                            <path d="M20 2l4 12 12-4-8 10 8 10-12-4-4 12-4-12-12 4 8-10-8-10 12 4z" />
                        </svg>

                        <b>BD</b>
                    </a>

                    <span class="sc">
                        Pengaturan akun
                    </span>

                    <h1>
                        Ubah Password
                    </h1>

                    <p>
                        Perbarui password akunmu untuk menjaga keamanan
                        akun dan data produk yang kamu kelola.
                    </p>

                    <ul class="auth-points">

                        <li>
                            <span>
                                <x-i n="lock" />
                            </span>
                            Gunakan password yang sulit ditebak
                        </li>

                        <li>
                            <span>
                                <x-i n="shield" />
                            </span>
                            Lindungi akun dan data produkmu
                        </li>

                        <li>
                            <span>
                                <x-i n="check" />
                            </span>
                            Password baru langsung aktif
                        </li>

                    </ul>

                    <svg class="deco" viewBox="0 0 40 40" fill="currentColor" aria-hidden="true">
                        <path d="M20 2l4 12 12-4-8 10 8 10-12-4-4 12-4-12-12 4 8-10-8-10 12 4z" />
                    </svg>

                </div>


                {{-- PANEL KANAN --}}
                <div class="auth-form">

                    <div class="auth-head">

                        <h2>Ubah Password</h2>

                        <p>
                            Masukkan password lama dan password baru kamu.
                        </p>

                    </div>


                    {{-- SUCCESS --}}
                    @if (session('status'))
                        <div class="auth-alert ok" role="status">
                            {{ session('status') }}
                        </div>
                    @endif


                    {{-- ERROR --}}
                    @if ($errors->any())
                        <div class="auth-alert bad">
                            Periksa kembali data yang kamu masukkan.
                        </div>
                    @endif


                    <form method="POST" action="{{ route('password.update') }}">

                        @csrf
                        @method('PUT')


                        {{-- PASSWORD LAMA --}}
                        <div class="auth-fld">

                            <label for="current_password">
                                Password Lama
                            </label>

                            <div class="auth-input">

                                <svg class="i" viewBox="0 0 24 24">
                                    <rect x="5" y="11" width="14" height="9" rx="2" />
                                    <path d="M8 11V8a4 4 0 018 0v3" />
                                </svg>

                                <input id="current_password" type="password" name="current_password" required
                                    autocomplete="current-password" placeholder="Masukkan password lama"
                                    class="{{ $errors->has('current_password') ? 'is-invalid' : '' }}">

                            </div>

                            @error('current_password')
                                <p class="auth-error">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- PASSWORD BARU --}}
                        <div class="auth-fld">

                            <label for="password">
                                Password Baru
                            </label>

                            <div class="auth-input">

                                <svg class="i" viewBox="0 0 24 24">
                                    <rect x="5" y="11" width="14" height="9" rx="2" />
                                    <path d="M8 11V8a4 4 0 018 0v3" />
                                </svg>

                                <input id="password" type="password" name="password" required autocomplete="new-password"
                                    placeholder="Masukkan password baru"
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
                                <p class="auth-error">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- KONFIRMASI PASSWORD --}}
                        <div class="auth-fld">

                            <label for="password_confirmation">
                                Konfirmasi Password Baru
                            </label>

                            <div class="auth-input">

                                <svg class="i" viewBox="0 0 24 24">
                                    <rect x="5" y="11" width="14" height="9" rx="2" />
                                    <path d="M8 11V8a4 4 0 018 0v3" />
                                </svg>

                                <input id="password_confirmation" type="password" name="password_confirmation" required
                                    autocomplete="new-password" placeholder="Ulangi password baru">

                            </div>

                        </div>


                        <button type="submit" class="btn p auth-submit">
                            Simpan Password

                            <x-i n="arr" />
                        </button>

                    </form>


                    <p class="auth-foot">

                        <a class="auth-link" href="{{ route('dashboard') }}">
                            Kembali ke dashboard
                        </a>

                    </p>

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

                tg.setAttribute(
                    'aria-label',
                    show ?
                    'Sembunyikan password' :
                    'Tampilkan password'
                );

            });
        </script>
    @endpush

@endsection
