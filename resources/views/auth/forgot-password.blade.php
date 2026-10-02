@extends('layouts.bd')

@section('title', 'Lupa Password')

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

                    <span class="sc">
                        Butuh bantuan?
                    </span>

                    <h1>
                        Lupa Password?
                    </h1>

                    <p>
                        Jangan khawatir. Masukkan email yang terdaftar dan
                        kami akan mengirimkan tautan untuk membuat password baru.
                    </p>

                    <ul class="auth-points">

                        <li>
                            <span>
                                <x-i n="mail" />
                            </span>
                            Masukkan email akun yang terdaftar
                        </li>

                        <li>
                            <span>
                                <x-i n="send" />
                            </span>
                            Cek tautan reset password di email
                        </li>

                        <li>
                            <span>
                                <x-i n="shield" />
                            </span>
                            Buat password baru dengan aman
                        </li>

                    </ul>

                    <svg class="deco" viewBox="0 0 40 40" fill="currentColor" aria-hidden="true">
                        <path d="M20 2l4 12 12-4-8 10 8 10-12-4-4 12-4-12-12 4 8-10-8-10 12 4z" />
                    </svg>

                </div>


                {{-- ============ PANEL KANAN: FORM ============ --}}
                <div class="auth-form">

                    <div class="auth-head">
                        <h2>Lupa Password</h2>

                        <p>
                            Masukkan email akunmu untuk menerima tautan reset password.
                        </p>
                    </div>


                    {{-- STATUS --}}
                    @if (session('status'))
                        <div class="auth-alert ok" role="status">
                            {{ session('status') }}
                        </div>
                    @endif


                    <form method="POST" action="{{ route('password.email') }}" novalidate>
                        @csrf


                        {{-- EMAIL --}}
                        <div class="auth-fld">

                            <label for="email">
                                Email
                            </label>

                            <div class="auth-input">

                                <x-i n="mail" />

                                <input id="email" type="email" name="email" value="{{ old('email') }}" required
                                    autofocus autocomplete="email" placeholder="nama@email.com"
                                    class="{{ $errors->has('email') ? 'is-invalid' : '' }}"
                                    aria-invalid="{{ $errors->has('email') ? 'true' : 'false' }}">

                            </div>

                            @error('email')
                                <p class="auth-error">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- SUBMIT --}}
                        <button type="submit" class="btn p auth-submit">
                            Kirim Link Reset

                            <x-i n="send" />
                        </button>

                    </form>


                    {{-- KEMBALI LOGIN --}}
                    <p class="auth-foot">

                        Ingat password?

                        <a class="auth-link" href="{{ route('login') }}">
                            Kembali masuk
                        </a>

                    </p>

                </div>

            </div>

        </div>
    </section>

@endsection
