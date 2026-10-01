@props(['p'])

@php
    use Illuminate\Support\Facades\Storage;

    $icon = match ($p->category?->name) {
        'Makanan & Minuman' => 'cup',
        'Fashion' => 'bag',
        'Craft' => 'sparkle',
        'Digital' => 'bulb',
        'Jasa' => 'wrench',
        'Stationery' => 'book',
        'Beauty & Health' => 'heart',
        default => 'bag',
    };

    $image = $p->images->first();
@endphp

<a class="card pd" data-cat="{{ $p->category?->slug }}" href="{{ route('products.show', $p->slug) }}">

    <div class="ph"
        @if ($image) style="background-image: url('{{ Storage::url($image->image) }}'); background-size: cover; background-position: center;"
        @else
            style="background:#f3e3d0;" @endif>

        @if (!$image)
            <x-i :n="$icon" />
        @endif
    </div>

    <div class="bd">

        <b>{{ $p->name }}</b>

        <small>
            {{ $p->category?->name ?? 'Produk' }}
        </small>

        <div class="pr">
            Rp {{ number_format($p->price, 0, ',', '.') }}
        </div>

        <div class="by">
            <span class="av">
                <x-i n="user" />
            </span>

            {{ $p->reseller?->nama_lengkap ?? 'Mahasiswa' }}
        </div>

    </div>

</a>
