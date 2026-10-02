<style>
    @media (max-width: 1023px) {
        body.fi-body {
            padding-bottom: calc(96px + env(safe-area-inset-bottom, 0px)) !important;
        }
    }
</style>

<nav class="bd-bottom-nav">
    {{-- isi nav kamu tetap sama --}}
</nav>
<nav class="bd-bottom-nav">
    <a href="{{ \App\Filament\Pages\Dashboard::getUrl() }}"
        class="bd-bn-item {{ request()->routeIs('filament.admin.pages.dashboard') ? 'on' : '' }}">
        <x-heroicon-o-home class="bd-bn-icon" />
        <span>Beranda</span>
    </a>

    <a href="{{ \App\Filament\Resources\Categories\CategoryResource::getUrl('index') }}"
        class="bd-bn-item {{ request()->routeIs('filament.admin.resources.categories.*') ? 'on' : '' }}">
        <x-heroicon-o-rectangle-stack class="bd-bn-icon" />
        <span>Kategori</span>
    </a>

    <a href="{{ \App\Filament\Resources\Products\ProductResource::getUrl('index') }}"
        class="bd-bn-item {{ request()->routeIs('filament.admin.resources.products.*') ? 'on' : '' }}">
        <x-heroicon-o-shopping-bag class="bd-bn-icon" />
        <span>Produk</span>
    </a>

    <a href="{{ \App\Filament\Resources\Resellers\ResellerResource::getUrl('index') }}"
        class="bd-bn-item {{ request()->routeIs('filament.admin.resources.resellers.*') ? 'on' : '' }}">
        <x-heroicon-o-users class="bd-bn-icon" />
        <span>Reseller</span>
    </a>

    <a href="{{ \App\Filament\Resources\ChatbotFaqs\ChatbotFaqResource::getUrl('index') }}"
        class="bd-bn-item {{ request()->routeIs('filament.admin.resources.chatbot-faqs.*') ? 'on' : '' }}">
        <x-heroicon-o-chat-bubble-left-right class="bd-bn-icon" />
        <span>FAQ</span>
    </a>

    <button type="button" class="bd-bn-item" x-data x-on:click="$store.sidebar.isOpen = ! $store.sidebar.isOpen">
        <x-heroicon-o-bars-3 class="bd-bn-icon" />
        <span>Menu</span>
    </button>
</nav>
