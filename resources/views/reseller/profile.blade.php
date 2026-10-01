@extends('layouts.dashboard')
@section('title', 'Profil Saya – BD')

@section('content')
    <div class="dash-top">
        <div>
            <p class="dash-eyebrow">Pengaturan</p>
            <h1 class="dash-h1">Profil Saya</h1>
            <p class="dash-sub">Informasi ini akan tampil di halaman "The People Behind The Products".</p>
        </div>
    </div>

    @if (session('status'))
        <div class="dash-flash">{{ session('status') }}</div>
    @endif

    <div class="dash-card">
        <form method="POST" action="{{ route('reseller.profile.update') }}" enctype="multipart/form-data" class="dash-form">
            @csrf @method('PUT')

            <div class="dash-form-photo">
                <div class="dash-avatar-lg">
                    @if ($reseller->foto ?? false)
                        <img src="{{ asset('storage/' . $reseller->foto) }}" alt="Foto profil">
                    @else
                        <x-i n="user" />
                    @endif
                </div>
                <label class="btn o">
                    Ganti Foto
                    <input type="file" name="foto" accept="image/*" hidden>
                </label>
            </div>

            <div class="two">
                <div class="fld"><label>Nama Lengkap</label><input name="nama_lengkap"
                        value="{{ old('nama_lengkap', $reseller->nama_lengkap ?? '') }}" required></div>
                <div class="fld"><label>Program Studi</label><input name="prodi"
                        value="{{ old('prodi', $reseller->prodi ?? '') }}"></div>
            </div>
            <div class="two">
                <div class="fld"><label>Nomor WhatsApp</label><input name="whatsapp"
                        value="{{ old('whatsapp', $reseller->whatsapp ?? '') }}" placeholder="6281234567890"></div>
                <div class="fld"><label>Instagram</label><input name="instagram"
                        value="{{ old('instagram', $reseller->instagram ?? '') }}" placeholder="@username"></div>
            </div>
            <div class="fld"><label>TikTok</label><input name="tiktok"
                    value="{{ old('tiktok', $reseller->tiktok ?? '') }}" placeholder="@username"></div>
            <div class="fld"><label>Bio</label>
                <textarea name="bio" rows="4">{{ old('bio', $reseller->bio ?? '') }}</textarea>
            </div>

            <button class="btn p" style="justify-self:start">Simpan Perubahan <x-i n="arr" /></button>
        </form>
    </div>
@endsection
