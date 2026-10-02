<x-filament-panels::page>
    @php($stats = $this->getStats())

    {{-- HERO WELCOME --}}
    <div
        class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-[#4d8fe6] via-[#5a9ae8] to-[#6ba8ef] p-8 text-white shadow-lg">
        <div class="absolute -right-10 -top-10 h-40 w-40 rounded-full bg-white/10"></div>
        <div class="absolute -bottom-16 right-24 h-32 w-32 rounded-full bg-white/5"></div>
        <p class="text-xs font-bold uppercase tracking-widest text-white/70">Business Development</p>
        <h1 class="mt-2 text-2xl font-extrabold tracking-tight">
            Selamat datang kembali, {{ auth()->user()->name }} 👋
        </h1>
        <p class="mt-2 max-w-md text-sm text-white/80">
            Kelola produk, reseller, kategori, dan konten BD Katalog dari satu tempat.
        </p>
    </div>

    {{-- STAT CARDS --}}
    <div class="mt-6 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">

        <div
            class="group rounded-3xl border border-[#dbe8fa] bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md dark:border-gray-700 dark:bg-gray-800">
            <div
                class="flex h-11 w-11 items-center justify-center rounded-2xl bg-[#e6f1ff] text-[#2b7fff] dark:bg-blue-900/30 dark:text-blue-400">
                <x-heroicon-o-shopping-bag class="h-5 w-5" />
            </div>
            <p class="mt-4 text-xs font-medium text-[#5f7396] dark:text-gray-400">Total Produk</p>
            <p class="mt-1 text-3xl font-extrabold text-[#0a2f74] dark:text-white">{{ $stats['total_products'] }}</p>
        </div>

        <div
            class="group rounded-3xl border border-[#dbe8fa] bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md dark:border-gray-700 dark:bg-gray-800">
            <div
                class="flex h-11 w-11 items-center justify-center rounded-2xl bg-amber-50 text-amber-600 dark:bg-amber-900/30 dark:text-amber-400">
                <x-heroicon-o-clock class="h-5 w-5" />
            </div>
            <p class="mt-4 text-xs font-medium text-[#5f7396] dark:text-gray-400">Menunggu Persetujuan</p>
            <p class="mt-1 text-3xl font-extrabold text-[#0a2f74] dark:text-white">{{ $stats['pending_products'] }}</p>
        </div>

        <div
            class="group rounded-3xl border border-[#dbe8fa] bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md dark:border-gray-700 dark:bg-gray-800">
            <div
                class="flex h-11 w-11 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-600 dark:bg-emerald-900/30 dark:text-emerald-400">
                <x-heroicon-o-check-circle class="h-5 w-5" />
            </div>
            <p class="mt-4 text-xs font-medium text-[#5f7396] dark:text-gray-400">Produk Disetujui</p>
            <p class="mt-1 text-3xl font-extrabold text-[#0a2f74] dark:text-white">{{ $stats['approved_products'] }}</p>
        </div>

        <div
            class="group rounded-3xl border border-[#dbe8fa] bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md dark:border-gray-700 dark:bg-gray-800">
            <div
                class="flex h-11 w-11 items-center justify-center rounded-2xl bg-violet-50 text-violet-600 dark:bg-violet-900/30 dark:text-violet-400">
                <x-heroicon-o-users class="h-5 w-5" />
            </div>
            <p class="mt-4 text-xs font-medium text-[#5f7396] dark:text-gray-400">Total Reseller</p>
            <p class="mt-1 text-3xl font-extrabold text-[#0a2f74] dark:text-white">{{ $stats['total_resellers'] }}</p>
        </div>

    </div>

    {{-- QUICK LINKS --}}
    <div class="mt-6 grid grid-cols-1 gap-4 lg:grid-cols-3">

        <a href="{{ \App\Filament\Resources\Products\ProductResource::getUrl('index', ['tableFilters[status][value]' => 'pending']) }}"
            class="flex items-center gap-4 rounded-3xl border border-[#dbe8fa] bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md dark:border-gray-700 dark:bg-gray-800">
            <div class="flex h-12 w-12 flex-none items-center justify-center rounded-2xl bg-[#e6f1ff] text-[#2b7fff]">
                <x-heroicon-o-magnifying-glass class="h-5 w-5" />
            </div>
            <div>
                <p class="text-sm font-bold text-[#0a2f74] dark:text-white">Periksa Produk Pending</p>
                <p class="text-xs text-[#5f7396] dark:text-gray-400">{{ $stats['pending_products'] }} produk menunggu
                    review</p>
            </div>
        </a>

        <a href="{{ \App\Filament\Resources\ChatbotFaqs\ChatbotFaqResource::getUrl('index') }}"
            class="flex items-center gap-4 rounded-3xl border border-[#dbe8fa] bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md dark:border-gray-700 dark:bg-gray-800">
            <div class="flex h-12 w-12 flex-none items-center justify-center rounded-2xl bg-[#e6f1ff] text-[#2b7fff]">
                <x-heroicon-o-chat-bubble-left-right class="h-5 w-5" />
            </div>
            <div>
                <p class="text-sm font-bold text-[#0a2f74] dark:text-white">Kelola FAQ Chatbot</p>
                <p class="text-xs text-[#5f7396] dark:text-gray-400">Tambah atau ubah pertanyaan B-Di</p>
            </div>
        </a>

        <a href="{{ \App\Filament\Resources\Resellers\ResellerResource::getUrl('index') }}"
            class="flex items-center gap-4 rounded-3xl border border-[#dbe8fa] bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md dark:border-gray-700 dark:bg-gray-800">
            <div class="flex h-12 w-12 flex-none items-center justify-center rounded-2xl bg-[#e6f1ff] text-[#2b7fff]">
                <x-heroicon-o-users class="h-5 w-5" />
            </div>
            <div>
                <p class="text-sm font-bold text-[#0a2f74] dark:text-white">Lihat Reseller</p>
                <p class="text-xs text-[#5f7396] dark:text-gray-400">{{ $stats['total_resellers'] }} mahasiswa terdaftar
                </p>
            </div>
        </a>

    </div>

    {{-- PRODUK TERBARU PENDING --}}
    @php(
    $latestPending = \App\Models\Product::where('status', 'pending')->with(['reseller', 'category'])->latest()->take(5)->get()
)

    <div class="mt-6 rounded-3xl border border-[#dbe8fa] bg-white p-6 shadow-sm dark:border-gray-700 dark:bg-gray-800">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs font-bold uppercase tracking-wide text-[#2b7fff]">Perlu Ditindak</p>
                <h2 class="mt-1 text-lg font-bold text-[#0a2f74] dark:text-white">Produk Menunggu Persetujuan</h2>
            </div>
            <a href="{{ \App\Filament\Resources\Products\ProductResource::getUrl('index') }}"
                class="text-xs font-semibold text-[#2b7fff] hover:underline">
                Lihat Semua →
            </a>
        </div>

        @if ($latestPending->isEmpty())
            <div
                class="mt-6 flex flex-col items-center justify-center rounded-2xl border border-dashed border-[#dbe8fa] py-10 text-center dark:border-gray-700">
                <x-heroicon-o-check-badge class="h-8 w-8 text-emerald-500" />
                <p class="mt-2 text-sm text-[#5f7396] dark:text-gray-400">Semua produk sudah diperiksa 🎉</p>
            </div>
        @else
            <div class="mt-4 divide-y divide-[#dbe8fa] dark:divide-gray-700">
                @foreach ($latestPending as $p)
                    <a href="{{ \App\Filament\Resources\Products\ProductResource::getUrl('view', ['record' => $p]) }}"
                        class="flex items-center justify-between gap-4 py-3 transition hover:bg-[#f4f9ff] dark:hover:bg-gray-700/30 rounded-xl px-2">
                        <div>
                            <p class="text-sm font-semibold text-[#0a2f74] dark:text-white">{{ $p->name }}</p>
                            <p class="text-xs text-[#5f7396] dark:text-gray-400">
                                {{ $p->reseller?->nama_lengkap ?? '-' }} · {{ $p->category?->name ?? '-' }}
                            </p>
                        </div>
                        <span
                            class="rounded-full bg-amber-50 px-3 py-1 text-xs font-bold text-amber-600 dark:bg-amber-900/30 dark:text-amber-400">
                            Menunggu
                        </span>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</x-filament-panels::page>
