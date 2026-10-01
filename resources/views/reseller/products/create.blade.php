@extends('layouts.dashboard')
@section('title', 'Tambah Produk – BD')

@section('content')
    <div class="dash-top">
        <div>
            <p class="dash-eyebrow">Produk Baru</p>
            <h1 class="dash-h1">Tambah Produk</h1>
            <p class="dash-sub">Tambahkan produk baru untuk ditampilkan di katalog.</p>
        </div>
    </div>

    @if ($errors->any())
        <div class="dash-flash bad">
            <strong>Periksa lagi form-nya:</strong>
            <ul>
                @foreach ($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('reseller.products.store') }}" enctype="multipart/form-data" class="dash-form"
        style="max-width:720px">
        @csrf

        <div class="dash-card">
            <h2 class="dash-form-h">Informasi Produk</h2>

            <div class="fld">
                <label>Nama Produk</label>
                <input name="name" value="{{ old('name') }}" required placeholder="Contoh: Crochet Bag">
            </div>

            <div class="two">
                <div class="fld">
                    <label>Kategori</label>
                    <select name="category_id" required>
                        <option value="">Pilih kategori</option>
                        @foreach ($categories as $c)
                            <option value="{{ $c->id }}" @selected(old('category_id') == $c->id)>{{ $c->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="fld">
                    <label>Harga (Rp)</label>
                    <input type="number" name="price" value="{{ old('price') }}" required min="0"
                        placeholder="85000">
                </div>
            </div>

            <div class="fld">
                <label>Deskripsi</label>
                <textarea name="description" rows="4" required placeholder="Ceritakan produkmu">{{ old('description') }}</textarea>
            </div>
        </div>

        <div class="dash-card">
            <h2 class="dash-form-h">Foto Produk</h2>

            <div class="fld">
                <label>Upload Foto (bisa lebih dari satu)</label>

                <input type="file" id="product-images" name="images[]" accept="image/*" multiple required>

                <small class="dash-sub">
                    Kamu bisa memilih foto beberapa kali. Semua foto akan tetap tersimpan.
                </small>

                <div id="image-preview" class="image-preview"></div>
            </div>
        </div>

        <div class="dash-card">
            <h2 class="dash-form-h">Keunggulan Produk</h2>
            <p class="dash-sub" style="margin-bottom:14px">Contoh: Handmade, Bahan berkualitas, Bisa custom warna.</p>
            <div id="hl-list" class="hl-list">
                <div class="fld"><input name="highlight_title[]" placeholder="Judul keunggulan"></div>
                <div class="fld"><input name="highlight_title[]" placeholder="Judul keunggulan"></div>
                <div class="fld"><input name="highlight_title[]" placeholder="Judul keunggulan"></div>
            </div>
            <button type="button" class="btn o" id="hl-add" style="margin-top:8px">+ Tambah Keunggulan</button>
        </div>

        <div class="cta">
            <a href="{{ route('reseller.products') }}" class="btn o">Batal</a>
            <button type="submit" class="btn p">Ajukan Produk <x-i n="arr" /></button>
        </div>
    </form>
@endsection

@push('scripts')
    <script>
        // =========================================
        // TAMBAH KEUNGGULAN
        // =========================================

        document.getElementById('hl-add')?.addEventListener('click', () => {
            const wrap = document.getElementById('hl-list');

            const f = document.createElement('div');
            f.className = 'fld';

            f.innerHTML = `
            <input
                name="highlight_title[]"
                placeholder="Judul keunggulan"
            >
        `;

            wrap.appendChild(f);
        });


        // =========================================
        // UPLOAD MULTIPLE FOTO
        // =========================================

        const imageInput = document.getElementById('product-images');
        const imagePreview = document.getElementById('image-preview');

        let selectedFiles = new DataTransfer();

        imageInput?.addEventListener('change', function() {

            // Tambahkan file baru ke kumpulan file sebelumnya
            Array.from(this.files).forEach(file => {
                selectedFiles.items.add(file);
            });

            // Masukkan kembali semua file ke input
            this.files = selectedFiles.files;

            renderImagePreview();
        });


        function renderImagePreview() {

            if (!imagePreview) return;

            imagePreview.innerHTML = '';

            Array.from(selectedFiles.files).forEach((file, index) => {

                const reader = new FileReader();

                reader.onload = function(e) {

                    const item = document.createElement('div');

                    item.className = 'image-preview-item';

                    item.innerHTML = `
                    <img src="${e.target.result}" alt="Foto ${index + 1}">

                    <div class="image-preview-info">
                        <span>Foto ${index + 1}</span>
                        <button
                            type="button"
                            onclick="removeImage(${index})"
                        >
                            Hapus
                        </button>
                    </div>
                `;

                    imagePreview.appendChild(item);
                };

                reader.readAsDataURL(file);
            });
        }


        function removeImage(index) {

            const newFiles = new DataTransfer();

            Array.from(selectedFiles.files).forEach((file, i) => {

                if (i !== index) {
                    newFiles.items.add(file);
                }

            });

            selectedFiles = newFiles;

            imageInput.files = selectedFiles.files;

            renderImagePreview();
        }
    </script>
@endpush
