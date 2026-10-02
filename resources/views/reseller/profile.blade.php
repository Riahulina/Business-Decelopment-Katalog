@extends('layouts.dashboard')

@section('title', 'Profil Saya – BD')

@section('content')

    @php
        $photo = $reseller->foto ?? null ? asset('storage/' . $reseller->foto) : null;
    @endphp

    <div class="dash-top">
        <div>
            <p class="dash-eyebrow">Pengaturan</p>
            <h1 class="dash-h1">Profil Saya</h1>
            <p class="dash-sub">
                Kelola informasi diri dan profil bisnis yang tampil di halaman "Sosok di Balik Produk".
            </p>
        </div>
    </div>


    @if (session('status'))
        <div class="dash-flash" style="max-width:900px">{{ session('status') }}</div>
    @endif

    @if ($errors->any())
        <div class="dash-flash bad" style="max-width:900px" role="alert">
            <strong>Periksa kembali form:</strong>
            <ul>
                @foreach ($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form method="POST" action="{{ route('reseller.profile.update') }}" enctype="multipart/form-data" class="f-form">
        @csrf
        @method('PUT')

        {{-- ================= 01 IDENTITAS ================= --}}
        <section class="f-card">

            <div class="f-head">
                <div class="f-num">01</div>

                <div>
                    <p>Profil</p>
                    <h2>Identitas Saya</h2>
                    <span>Informasi dasar yang akan dikenali oleh pengunjung katalog.</span>
                </div>
            </div>

            <div class="f-body">
                <div class="pr-id">

                    <div class="pr-avatar-wrap">

                        <div class="pr-avatar" id="pr-avatar">
                            @if ($photo)
                                <img src="{{ $photo }}" alt="Foto profil">
                            @else
                                <x-i n="user" />
                            @endif
                        </div>

                        <label for="profile-photo" class="pr-photo-btn">
                            <x-i n="plus" />
                            Ganti Foto
                        </label>

                        <input type="file" id="profile-photo" name="foto" accept="image/*" hidden>

                    </div>

                    <div class="pr-id-info">
                        <span class="tag">Profil reseller</span>

                        <h3>{{ $reseller->nama_lengkap ?? 'Nama Lengkap' }}</h3>

                        <p>{{ $reseller->prodi ?? 'Program studi belum diisi' }}</p>

                        <small>
                            Setelah memilih foto, geser dan atur zoom sampai wajahmu pas di bingkai.
                            Foto ini tampil di bagian "Sosok di Balik Produk".
                        </small>
                    </div>

                </div>
            </div>

        </section>


        {{-- ================= 02 DATA DIRI ================= --}}
        <section class="f-card">

            <div class="f-head">
                <div class="f-num">02</div>

                <div>
                    <p>Informasi dasar</p>
                    <h2>Data Diri</h2>
                    <span>Pastikan nama dan program studi yang kamu masukkan sudah benar.</span>
                </div>
            </div>

            <div class="f-body">
                <div class="f-two" style="margin-bottom:0">

                    <div class="f-field">
                        <label for="nama_lengkap">Nama Lengkap <span class="req">*</span></label>
                        <input id="nama_lengkap" name="nama_lengkap"
                            value="{{ old('nama_lengkap', $reseller->nama_lengkap ?? '') }}" required
                            placeholder="Nama lengkap">
                    </div>

                    <div class="f-field">
                        <label for="prodi">Program Studi</label>
                        <input id="prodi" name="prodi" value="{{ old('prodi', $reseller->prodi ?? '') }}"
                            placeholder="Contoh: Manajemen Informatika">
                    </div>

                </div>
            </div>

        </section>


        {{-- ================= 03 KONTAK ================= --}}
        <section class="f-card">

            <div class="f-head">
                <div class="f-num">03</div>

                <div>
                    <p>Kontak</p>
                    <h2>Hubungi Saya</h2>
                    <span>Informasi kontak untuk memudahkan pengunjung terhubung denganmu.</span>
                </div>
            </div>

            <div class="f-body">

                <div class="f-two">

                    <div class="f-field">
                        <label for="whatsapp">Nomor WhatsApp</label>

                        <div class="f-pre">
                            <span>WA</span>
                            <input id="whatsapp" name="whatsapp" inputmode="numeric"
                                value="{{ old('whatsapp', $reseller->whatsapp ?? '') }}" placeholder="6281234567890">
                        </div>

                        <small>Gunakan format 62..., tanpa tanda + atau spasi.</small>
                    </div>

                    <div class="f-field">
                        <label for="instagram">Instagram</label>

                        <div class="f-pre">
                            <span>IG</span>
                            <input id="instagram" name="instagram"
                                value="{{ old('instagram', $reseller->instagram ?? '') }}" placeholder="@username">
                        </div>
                    </div>

                </div>

                <div class="f-field">
                    <label for="tiktok">TikTok</label>

                    <div class="f-pre">
                        <span>TT</span>
                        <input id="tiktok" name="tiktok" value="{{ old('tiktok', $reseller->tiktok ?? '') }}"
                            placeholder="@username">
                    </div>
                </div>

            </div>

        </section>


        {{-- ================= 04 BIO ================= --}}
        <section class="f-card">

            <div class="f-head">
                <div class="f-num">04</div>

                <div>
                    <p>Tentang saya</p>
                    <h2>Bio</h2>
                    <span>Ceritakan sedikit tentang dirimu atau bisnis yang kamu jalankan.</span>
                </div>
            </div>

            <div class="f-body">
                <div class="f-field">
                    <label for="bio">Bio Singkat</label>

                    <textarea id="bio" name="bio" rows="5"
                        placeholder="Ceritakan tentang dirimu, produk, atau bisnis yang kamu jalankan...">{{ old('bio', $reseller->bio ?? '') }}</textarea>

                    <div class="f-meta">
                        <small>Buat bio singkat, jelas, dan mudah dipahami.</small>
                        <span class="count" id="bio-count">0 karakter</span>
                    </div>
                </div>
            </div>

        </section>


        {{-- ================= SIMPAN ================= --}}
        <div class="f-foot">

            <div class="f-foot-info">
                <div class="f-foot-ic"><x-i n="check" /></div>

                <div>
                    <strong>Profil sudah sesuai?</strong>
                    <p>Simpan perubahan agar informasi terbaru tampil di katalog.</p>
                </div>
            </div>

            <div class="f-actions">
                <a href="{{ route('dashboard') }}" class="btn o">Batal</a>

                <button type="submit" class="btn p">
                    Simpan Perubahan
                    <x-i n="arr" />
                </button>
            </div>

        </div>

    </form>


    {{-- ================= PENGATUR FOTO ================= --}}
    <div class="crop-modal" id="crop-modal" hidden role="dialog" aria-modal="true" aria-labelledby="crop-title">
        <div class="crop-box">

            <div class="crop-head">
                <h3 id="crop-title">Atur Foto Profil</h3>
                <button type="button" class="crop-close" data-crop-cancel aria-label="Tutup">×</button>
            </div>

            <p class="crop-hint">Geser foto dan atur zoom sampai wajahmu pas di dalam bingkai bulat.</p>

            <div class="crop-stage" id="crop-stage">
                <img id="crop-img" alt="" draggable="false">
                <div class="crop-mask"></div>
            </div>

            <div class="crop-zoom">
                <svg class="i" viewBox="0 0 24 24">
                    <circle cx="11" cy="11" r="7" />
                    <path d="M21 21l-4-4M8 11h6" />
                </svg>

                <input type="range" id="crop-zoom" min="1" max="3" step="0.01" value="1"
                    aria-label="Zoom foto">

                <svg class="i" viewBox="0 0 24 24">
                    <circle cx="11" cy="11" r="7" />
                    <path d="M21 21l-4-4M8 11h6M11 8v6" />
                </svg>
            </div>

            <div class="crop-actions">
                <button type="button" class="btn o" data-crop-cancel>Batal</button>
                <button type="button" class="btn p" id="crop-apply">Terapkan</button>
            </div>

        </div>
    </div>

@endsection


@push('scripts')
    <script>
        (() => {
            /* ---------- Counter bio ---------- */
            const bio = document.getElementById('bio');
            const bioCount = document.getElementById('bio-count');
            const updateBio = () => bioCount.textContent = `${bio.value.length} karakter`;

            bio.addEventListener('input', updateBio);
            updateBio();


            /* ---------- Pengatur foto (geser + zoom, hasil persegi 512px) ---------- */
            const input = document.getElementById('profile-photo');
            const avatar = document.getElementById('pr-avatar');
            const modal = document.getElementById('crop-modal');
            const stage = document.getElementById('crop-stage');
            const img = document.getElementById('crop-img');
            const zoomEl = document.getElementById('crop-zoom');
            const OUT = 512;

            let objectUrl = null;
            let S = 0; // ukuran bingkai (px)
            let base = 1; // skala dasar (foto menutupi bingkai)
            let zoom = 1;
            let x = 0,
                y = 0; // posisi pojok kiri atas foto di dalam bingkai

            const clamp = () => {
                const w = img.naturalWidth * base * zoom;
                const h = img.naturalHeight * base * zoom;

                x = Math.min(0, Math.max(S - w, x));
                y = Math.min(0, Math.max(S - h, y));
            };

            const paint = () => {
                clamp();

                img.style.width = img.naturalWidth * base * zoom + 'px';
                img.style.height = img.naturalHeight * base * zoom + 'px';
                img.style.transform = `translate(${x}px, ${y}px)`;
            };

            const setZoom = next => {
                next = Math.min(3, Math.max(1, next));

                // pertahankan titik tengah bingkai saat zoom
                const w = img.naturalWidth * base * zoom;
                const h = img.naturalHeight * base * zoom;
                const cx = (S / 2 - x) / w;
                const cy = (S / 2 - y) / h;

                zoom = next;

                x = S / 2 - cx * img.naturalWidth * base * zoom;
                y = S / 2 - cy * img.naturalHeight * base * zoom;

                zoomEl.value = zoom;
                paint();
            };

            const openModal = () => {
                modal.hidden = false;
                document.body.style.overflow = 'hidden';
            };

            const closeModal = () => {
                modal.hidden = true;
                document.body.style.overflow = '';

                if (objectUrl) {
                    URL.revokeObjectURL(objectUrl);
                    objectUrl = null;
                }
            };

            input.addEventListener('change', () => {
                const file = input.files[0];
                if (!file) return;

                if (!file.type.startsWith('image/')) {
                    input.value = '';
                    return alert('File harus berupa gambar.');
                }

                objectUrl = URL.createObjectURL(file);

                img.onload = () => {
                    openModal();

                    S = stage.clientWidth;
                    base = S / Math.min(img.naturalWidth, img.naturalHeight);
                    zoom = 1;
                    zoomEl.value = 1;

                    // mulai di tengah foto
                    x = (S - img.naturalWidth * base) / 2;
                    y = (S - img.naturalHeight * base) / 2;

                    paint();
                };

                img.src = objectUrl;
            });

            zoomEl.addEventListener('input', () => setZoom(parseFloat(zoomEl.value)));

            stage.addEventListener('wheel', e => {
                e.preventDefault();
                setZoom(zoom + (e.deltaY < 0 ? 0.08 : -0.08));
            }, {
                passive: false
            });

            /* geser dengan mouse / jari */
            let drag = null;

            stage.addEventListener('pointerdown', e => {
                drag = {
                    px: e.clientX,
                    py: e.clientY,
                    x,
                    y
                };
                stage.setPointerCapture(e.pointerId);
                stage.classList.add('drag');
            });

            stage.addEventListener('pointermove', e => {
                if (!drag) return;

                x = drag.x + (e.clientX - drag.px);
                y = drag.y + (e.clientY - drag.py);
                paint();
            });

            const endDrag = () => {
                drag = null;
                stage.classList.remove('drag');
            };

            stage.addEventListener('pointerup', endDrag);
            stage.addEventListener('pointercancel', endDrag);

            /* batal: kosongkan pilihan supaya foto mentah tidak ikut terkirim */
            const cancel = () => {
                input.value = '';
                closeModal();
            };

            modal.querySelectorAll('[data-crop-cancel]').forEach(b => b.addEventListener('click', cancel));
            modal.addEventListener('click', e => {
                if (e.target === modal) cancel();
            });
            document.addEventListener('keydown', e => {
                if (e.key === 'Escape' && !modal.hidden) cancel();
            });

            /* terapkan: potong sesuai bingkai -> jadi file baru di input */
            document.getElementById('crop-apply').addEventListener('click', () => {
                const scale = base * zoom;
                const canvas = document.createElement('canvas');

                canvas.width = canvas.height = OUT;

                const ctx = canvas.getContext('2d');
                ctx.fillStyle = '#fff';
                ctx.fillRect(0, 0, OUT, OUT);
                ctx.drawImage(img, -x / scale, -y / scale, S / scale, S / scale, 0, 0, OUT, OUT);

                canvas.toBlob(blob => {
                    const file = new File([blob], 'foto-profil.jpg', {
                        type: 'image/jpeg'
                    });
                    const dt = new DataTransfer();

                    dt.items.add(file);
                    input.files = dt.files;

                    avatar.innerHTML =
                        `<img src="${canvas.toDataURL('image/jpeg', 0.9)}" alt="Foto profil baru">`;

                    closeModal();
                }, 'image/jpeg', 0.9);
            });
        })();
    </script>
@endpush
