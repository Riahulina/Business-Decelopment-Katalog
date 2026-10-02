@extends('layouts.dashboard')

@section('title', 'Profil Saya – BD')

@section('content')

    {{-- =========================================================
         HEADER
    ========================================================== --}}
    <div class="dash-top profile-page-head">

        <div>

            <p class="dash-eyebrow">
                Pengaturan
            </p>

            <h1 class="dash-h1">
                Profil Saya
            </h1>

            <p class="dash-sub">
                Kelola informasi diri dan profil bisnis yang tampil
                di halaman "The People Behind The Products".
            </p>

        </div>

    </div>


    {{-- =========================================================
         STATUS
    ========================================================== --}}
    @if (session('status'))
        <div class="profile-alert">
            <div class="profile-alert-icon">
                <x-i n="check" />
            </div>

            <span>
                {{ session('status') }}
            </span>
        </div>
    @endif


    {{-- =========================================================
         FORM
    ========================================================== --}}
    <form method="POST" action="{{ route('reseller.profile.update') }}" enctype="multipart/form-data" class="profile-form">

        @csrf
        @method('PUT')


        {{-- =====================================================
             IDENTITY
        ====================================================== --}}
        <section class="profile-card">

            <div class="profile-card-head">

                <div class="profile-section-number">
                    01
                </div>

                <div>

                    <p>
                        PROFIL
                    </p>

                    <h2>
                        Identitas Saya
                    </h2>

                    <span>
                        Informasi dasar yang akan dikenali oleh pengunjung katalog.
                    </span>

                </div>

            </div>


            <div class="profile-card-body">

                <div class="profile-identity">

                    <div class="profile-avatar-wrap">

                        <div class="profile-avatar">

                            @if ($reseller->foto ?? false)
                                <img src="{{ asset('storage/' . $reseller->foto) }}"
                                    alt="Foto profil {{ $reseller->nama_lengkap }}">
                            @else
                                <x-i n="user" />
                            @endif

                        </div>


                        <label for="profile-photo" class="profile-photo-btn">

                            <x-i n="plus" />

                            Ganti Foto

                            <input type="file" id="profile-photo" name="foto" accept="image/*" hidden>

                        </label>

                    </div>


                    <div class="profile-identity-info">

                        <span class="profile-identity-label">
                            PROFIL RESELLER
                        </span>

                        <h3>
                            {{ $reseller->nama_lengkap ?? 'Nama Lengkap' }}
                        </h3>

                        <p>
                            {{ $reseller->prodi ?? 'Program Studi belum diisi' }}
                        </p>

                        <small>
                            Foto profil akan digunakan pada bagian
                            "The People Behind The Products".
                        </small>

                    </div>

                </div>

            </div>

        </section>


        {{-- =====================================================
             DATA DIRI
        ====================================================== --}}
        <section class="profile-card">

            <div class="profile-card-head">

                <div class="profile-section-number">
                    02
                </div>

                <div>

                    <p>
                        INFORMASI DASAR
                    </p>

                    <h2>
                        Data Diri
                    </h2>

                    <span>
                        Pastikan nama dan program studi yang kamu masukkan sudah benar.
                    </span>

                </div>

            </div>


            <div class="profile-card-body">

                <div class="profile-two">

                    {{-- NAMA --}}
                    <div class="profile-field">

                        <label for="nama_lengkap">
                            Nama Lengkap
                            <span>*</span>
                        </label>

                        <input id="nama_lengkap" name="nama_lengkap"
                            value="{{ old('nama_lengkap', $reseller->nama_lengkap ?? '') }}" required
                            placeholder="Nama lengkap">

                    </div>


                    {{-- PRODI --}}
                    <div class="profile-field">

                        <label for="prodi">
                            Program Studi
                        </label>

                        <input id="prodi" name="prodi" value="{{ old('prodi', $reseller->prodi ?? '') }}"
                            placeholder="Contoh: Manajemen Informatika">

                    </div>

                </div>

            </div>

        </section>


        {{-- =====================================================
             KONTAK
        ====================================================== --}}
        <section class="profile-card">

            <div class="profile-card-head">

                <div class="profile-section-number">
                    03
                </div>

                <div>

                    <p>
                        KONTAK
                    </p>

                    <h2>
                        Hubungi Saya
                    </h2>

                    <span>
                        Informasi kontak untuk memudahkan pengunjung terhubung denganmu.
                    </span>

                </div>

            </div>


            <div class="profile-card-body">

                <div class="profile-two">

                    {{-- WHATSAPP --}}
                    <div class="profile-field">

                        <label for="whatsapp">
                            Nomor WhatsApp
                        </label>

                        <div class="profile-input-icon">

                            <span>
                                WA
                            </span>

                            <input id="whatsapp" name="whatsapp" value="{{ old('whatsapp', $reseller->whatsapp ?? '') }}"
                                placeholder="6281234567890">

                        </div>

                        <small>
                            Gunakan format nomor tanpa tanda + atau spasi.
                        </small>

                    </div>


                    {{-- INSTAGRAM --}}
                    <div class="profile-field">

                        <label for="instagram">
                            Instagram
                        </label>

                        <div class="profile-input-icon">

                            <span>
                                IG
                            </span>

                            <input id="instagram" name="instagram"
                                value="{{ old('instagram', $reseller->instagram ?? '') }}" placeholder="@username">

                        </div>

                    </div>

                </div>


                {{-- TIKTOK --}}
                <div class="profile-field profile-field-last">

                    <label for="tiktok">
                        TikTok
                    </label>

                    <div class="profile-input-icon">

                        <span>
                            TT
                        </span>

                        <input id="tiktok" name="tiktok" value="{{ old('tiktok', $reseller->tiktok ?? '') }}"
                            placeholder="@username">

                    </div>

                </div>

            </div>

        </section>


        {{-- =====================================================
             BIO
        ====================================================== --}}
        <section class="profile-card">

            <div class="profile-card-head">

                <div class="profile-section-number">
                    04
                </div>

                <div>

                    <p>
                        TENTANG SAYA
                    </p>

                    <h2>
                        Bio
                    </h2>

                    <span>
                        Ceritakan sedikit tentang dirimu atau bisnis yang kamu jalankan.
                    </span>

                </div>

            </div>


            <div class="profile-card-body">

                <div class="profile-field profile-field-last">

                    <label for="bio">
                        Bio Singkat
                    </label>

                    <textarea id="bio" name="bio" rows="5"
                        placeholder="Ceritakan tentang dirimu, produk, atau bisnis yang kamu jalankan...">{{ old('bio', $reseller->bio ?? '') }}</textarea>

                    <div class="profile-field-bottom">

                        <small>
                            Buat bio singkat, jelas, dan mudah dipahami.
                        </small>

                        <span id="bio-count">
                            0 karakter
                        </span>

                    </div>

                </div>

            </div>

        </section>


        {{-- =====================================================
             SAVE
        ====================================================== --}}
        <div class="profile-footer">

            <div class="profile-footer-info">

                <div class="profile-footer-icon">
                    <x-i n="check" />
                </div>

                <div>

                    <strong>
                        Profil sudah sesuai?
                    </strong>

                    <p>
                        Simpan perubahan agar informasi terbaru tampil di katalog.
                    </p>

                </div>

            </div>


            <div class="profile-actions">

                <a href="{{ route('dashboard') }}" class="profile-cancel">
                    Batal
                </a>

                <button type="submit" class="profile-submit">
                    Simpan Perubahan
                    <x-i n="arr" />
                </button>

            </div>

        </div>

    </form>

@endsection




@push('scripts')
    <script>
        /* =========================================================
               BIO CHARACTER COUNT
            ========================================================= */

        const bioInput =
            document.getElementById('bio');

        const bioCount =
            document.getElementById('bio-count');


        function updateBioCount() {

            if (!bioInput || !bioCount) return;

            const total =
                bioInput.value.length;

            bioCount.textContent =
                `${total} karakter`;

        }


        bioInput?.addEventListener(
            'input',
            updateBioCount
        );

        updateBioCount();


        /* =========================================================
           PREVIEW FOTO PROFIL
        ========================================================= */

        const profilePhoto =
            document.getElementById('profile-photo');

        const profileAvatar =
            document.querySelector('.profile-avatar');


        profilePhoto?.addEventListener('change', function() {

            const file = this.files?.[0];

            if (!file || !profileAvatar) return;

            const reader =
                new FileReader();

            reader.onload = function(e) {

                profileAvatar.innerHTML = `
            <img
                src="${e.target.result}"
                alt="Preview foto profil"
            >
        `;

            };

            reader.readAsDataURL(file);

        });
    </script>
@endpush
