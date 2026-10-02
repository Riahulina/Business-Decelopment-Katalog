@extends('layouts.dashboard')

@section('title', 'Tambah Produk – BD')

@section('content')

    <div class="dash-top">
        <div>
            <p class="dash-eyebrow">Produk Baru</p>
            <h1 class="dash-h1">Tambah Produk</h1>
            <p class="dash-sub">Lengkapi informasi produkmu sebelum diajukan ke katalog BD.</p>
        </div>
    </div>


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


    <form method="POST" action="{{ route('reseller.products.store') }}" enctype="multipart/form-data" class="f-form">
        @csrf

        {{-- ================= 01 INFORMASI ================= --}}
        <section class="f-card">

            <div class="f-head">
                <div class="f-num">01</div>

                <div>
                    <p>Informasi dasar</p>
                    <h2>Informasi Produk</h2>
                    <span>Berikan informasi utama mengenai produk yang kamu jual.</span>
                </div>
            </div>

            <div class="f-body">

                <div class="f-field">
                    <label for="product-name">Nama Produk <span class="req">*</span></label>

                    <input id="product-name" type="text" name="name" value="{{ old('name') }}" required
                        placeholder="Contoh: Crochet Bag">

                    <small>Gunakan nama produk yang singkat dan mudah dikenali.</small>
                </div>


                <div class="f-two">

                    <div class="f-field">
                        <label for="product-category">Kategori <span class="req">*</span></label>

                        <select id="product-category" name="category_id" required>
                            <option value="">Pilih kategori</option>

                            @foreach ($categories as $c)
                                <option value="{{ $c->id }}" @selected(old('category_id') == $c->id)>
                                    {{ $c->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>


                    <div class="f-field">
                        <label for="product-price">Harga <span class="req">*</span></label>

                        <div class="f-pre">
                            <span>Rp</span>

                            <input id="product-price" type="number" name="price" value="{{ old('price') }}" required
                                min="0" inputmode="numeric" placeholder="85000">
                        </div>

                        <small id="price-hint">&nbsp;</small>
                    </div>

                </div>


                <div class="f-field">
                    <label for="product-description">Deskripsi Produk <span class="req">*</span></label>

                    <textarea id="product-description" name="description" rows="5" required
                        placeholder="Ceritakan produkmu, bahan yang digunakan, ukuran, fungsi, atau informasi penting lainnya.">{{ old('description') }}</textarea>

                    <div class="f-meta">
                        <small>Jelaskan produk dengan singkat tetapi informatif.</small>
                        <span class="count" id="description-count">0 karakter</span>
                    </div>
                </div>

            </div>

        </section>


        {{-- ================= 02 FOTO ================= --}}
        <section class="f-card">

            <div class="f-head">
                <div class="f-num">02</div>

                <div>
                    <p>Visual produk</p>
                    <h2>Foto Produk</h2>
                    <span>Gunakan foto yang jelas agar produk lebih menarik dilihat. Foto pertama jadi foto utama.</span>
                </div>
            </div>

            <div class="f-body">

                <div class="pf-drop" id="pf-drop">

                    <input type="file" id="product-images" name="images[]" accept="image/*" multiple required
                        aria-label="Pilih foto produk">

                    <div class="pf-drop-ic"><x-i n="plus" /></div>

                    <strong>Pilih atau tarik foto ke sini</strong>
                    <span>Bisa lebih dari satu foto, dan bisa ditambah beberapa kali</span>
                    <small>JPG, JPEG, PNG · Maks. 2 MB per foto</small>

                </div>

                <div class="pf-count" id="pf-count"></div>

                <div class="pf-previews" id="image-preview"></div>

            </div>

        </section>


        {{-- ================= 03 KEUNGGULAN ================= --}}
        <section class="f-card">

            <div class="f-head">
                <div class="f-num">03</div>

                <div>
                    <p>Nilai tambah</p>
                    <h2>Keunggulan Produk</h2>
                    <span>Tambahkan beberapa hal yang membuat produkmu menarik.</span>
                </div>
            </div>

            <div class="f-body">

                <div class="pf-intro">
                    <div class="pf-intro-ic"><x-i n="sparkle" /></div>

                    <p>Contoh: Handmade, Bahan berkualitas, Bisa custom warna, Ramah lingkungan.</p>
                </div>

                <div class="pf-hl-list" id="hl-list">
                    @foreach (['Contoh: Handmade', 'Contoh: Bahan berkualitas', 'Contoh: Bisa custom'] as $ph)
                        <div class="pf-hl">
                            <span class="pf-hl-n">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                            <input name="highlight_title[]" placeholder="{{ $ph }}">
                            <button type="button" class="pf-hl-x" aria-label="Hapus keunggulan">×</button>
                        </div>
                    @endforeach
                </div>

                <button type="button" class="pf-add" id="hl-add">
                    <x-i n="plus" />
                    Tambah Keunggulan
                </button>

            </div>

        </section>


        {{-- ================= SIMPAN ================= --}}
        <div class="f-foot">

            <div class="f-foot-info">
                <div class="f-foot-ic"><x-i n="sparkle" /></div>

                <div>
                    <strong>Siap diajukan?</strong>
                    <p>Produk akan diperiksa BD sebelum tampil di katalog.</p>
                </div>
            </div>

            <div class="f-actions">
                <a href="{{ route('reseller.products') }}" class="btn o">Batal</a>

                <button type="submit" class="btn p">
                    Ajukan Produk
                    <x-i n="arr" />
                </button>
            </div>

        </div>

    </form>

@endsection


@push('scripts')
    <script>
        (() => {
            const say = msg => (typeof toast === 'function' ? toast(msg) : alert(msg));

            /* ---------- Counter deskripsi + hint harga ---------- */
            const desc = document.getElementById('product-description');
            const descCount = document.getElementById('description-count');
            const price = document.getElementById('product-price');
            const priceHint = document.getElementById('price-hint');

            const updateDesc = () => descCount.textContent = `${desc.value.length} karakter`;
            const updatePrice = () => {
                const v = parseInt(price.value, 10);
                priceHint.innerHTML = v > 0 ? 'Tampil sebagai Rp ' + v.toLocaleString('id-ID') : '&nbsp;';
            };

            desc.addEventListener('input', updateDesc);
            price.addEventListener('input', updatePrice);
            updateDesc();
            updatePrice();


            /* ---------- Keunggulan: tambah / hapus ---------- */
            const hlList = document.getElementById('hl-list');

            const renumber = () => hlList.querySelectorAll('.pf-hl').forEach((row, i) => {
                row.querySelector('.pf-hl-n').textContent = String(i + 1).padStart(2, '0');
            });

            document.getElementById('hl-add').addEventListener('click', () => {
                const row = document.createElement('div');
                row.className = 'pf-hl';
                row.innerHTML = `
                    <span class="pf-hl-n"></span>
                    <input name="highlight_title[]" placeholder="Judul keunggulan">
                    <button type="button" class="pf-hl-x" aria-label="Hapus keunggulan">×</button>`;
                hlList.appendChild(row);
                renumber();
                row.querySelector('input').focus();
            });

            hlList.addEventListener('click', e => {
                const btn = e.target.closest('.pf-hl-x');
                if (!btn) return;

                btn.closest('.pf-hl').remove();
                renumber();
            });


            /* ---------- Upload banyak foto ---------- */
            const input = document.getElementById('product-images');
            const drop = document.getElementById('pf-drop');
            const preview = document.getElementById('image-preview');
            const counter = document.getElementById('pf-count');
            const MAX = 2 * 1024 * 1024;

            let store = new DataTransfer();
            let urls = [];

            const sameFile = (a, b) => a.name === b.name && a.size === b.size && a.lastModified === b.lastModified;

            function addFiles(list) {
                Array.from(list).forEach(file => {
                    if (!file.type.startsWith('image/')) return say(`${file.name} bukan gambar`);
                    if (file.size > MAX) return say(`${file.name} lebih dari 2 MB`);
                    if (Array.from(store.files).some(f => sameFile(f, file))) return;

                    store.items.add(file);
                });

                input.files = store.files;
                render();
            }

            function render() {
                urls.forEach(u => URL.revokeObjectURL(u));
                urls = [];
                preview.innerHTML = '';

                Array.from(store.files).forEach((file, i) => {
                    const url = URL.createObjectURL(file);
                    urls.push(url);

                    const item = document.createElement('div');
                    item.className = 'pf-prev';
                    item.innerHTML = `
                        <img src="${url}" alt="Foto ${i + 1}">
                        ${i === 0 ? '<span class="pf-prev-main">Foto utama</span>' : ''}
                        <button type="button" class="pf-prev-x" data-i="${i}" aria-label="Hapus foto">×</button>
                        <div class="pf-prev-info"><span></span><small></small></div>`;

                    item.querySelector('.pf-prev-info span').textContent = file.name;
                    item.querySelector('.pf-prev-info small').textContent = Math.round(file.size / 1024) +
                        ' KB';

                    preview.appendChild(item);
                });

                counter.textContent = store.files.length ? `${store.files.length} foto dipilih` : '';
            }

            input.addEventListener('change', () => addFiles(input.files));

            preview.addEventListener('click', e => {
                const btn = e.target.closest('[data-i]');
                if (!btn) return;

                const idx = Number(btn.dataset.i);
                const next = new DataTransfer();

                Array.from(store.files).forEach((f, i) => {
                    if (i !== idx) next.items.add(f);
                });

                store = next;
                input.files = store.files;
                render();
            });

            ['dragenter', 'dragover'].forEach(ev => drop.addEventListener(ev, () => drop.classList.add('drag')));
            ['dragleave', 'drop'].forEach(ev => drop.addEventListener(ev, () => drop.classList.remove('drag')));
        })();
    </script>
@endpush
