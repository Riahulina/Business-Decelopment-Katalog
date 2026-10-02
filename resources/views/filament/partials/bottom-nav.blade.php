<style>
    @media (max-width: 1023px) {
        body.fi-body {
            padding-bottom: calc(96px + env(safe-area-inset-bottom, 0px)) !important;
        }

        /* sembunyikan tombol garis 3 / X di topbar */
        .fi-topbar-open-sidebar-btn,
        .fi-topbar-close-sidebar-btn {
            display: none !important;
        }
    }

    @media (min-width: 1024px) {

        .bd-sheet-overlay,
        .bd-sheet {
            display: none !important;
        }
    }

    .bd-sheet-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, .4);
        z-index: 9998;
    }

    .bd-sheet {
        position: fixed;
        left: 12px;
        right: 12px;
        bottom: calc(84px + env(safe-area-inset-bottom, 0px));
        background: #fff;
        border-radius: 16px;
        padding: 8px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, .2);
        z-index: 9999;
    }

    .bd-sheet a,
    .bd-sheet button {
        display: flex;
        align-items: center;
        gap: 12px;
        width: 100%;
        padding: 14px 12px;
        font-size: 15px;
        font-weight: 500;
        color: #111827;
        border-radius: 10px;
        text-align: left;
    }

    .bd-sheet a:active,
    .bd-sheet button:active {
        background: #f3f4f6;
    }

    .bd-sheet .bd-danger {
        color: #dc2626;
    }

    .bd-sheet svg {
        width: 20px;
        height: 20px;
    }

    .bd-back-btn {
        display: none;
    }

    @media (max-width: 1023px) {
        .bd-back-btn {
            display: flex;
            align-items: center;
            gap: 8px;
            position: fixed;
            top: calc(12px + env(safe-area-inset-top, 0px));
            left: 12px;
            z-index: 60;
            padding: 9px 16px 9px 12px;
            border-radius: 99px;
            background: #ffffff;
            color: #111827;
            font-size: 13px;
            font-weight: 600;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.14);
            border: 1px solid #e5e7eb;
        }

        .bd-back-btn svg {
            width: 18px;
            height: 18px;
        }

        .bd-back-btn:active {
            background: #f3f4f6;
        }
    }
</style>

<div x-data="{ menuOpen: false }" x-on:keydown.escape.window="menuOpen = false">

    {{-- Panel menu (muncul saat tombol Menu ditekan) --}}
    <div class="bd-sheet-overlay" x-show="menuOpen" x-cloak x-on:click="menuOpen = false"></div>

    <div class="bd-sheet" x-show="menuOpen" x-cloak x-transition>
        <a href="{{ url('/admin/news') }}">
            <x-heroicon-o-newspaper />
            <span>News</span>
        </a>
        <a href="{{ \App\Filament\Resources\Collaborations\CollaborationResource::getUrl('index') }}">
            <x-heroicon-o-user-group />
            <span>Kolaborasi</span>
        </a>

        <form method="POST" action="{{ filament()->getLogoutUrl() }}">
            @csrf
            <button type="submit" class="bd-danger">
                <x-heroicon-o-arrow-right-on-rectangle />
                <span>Log out</span>
            </button>
        </form>
    </div>

    @php
        $isListOrDashboard = request()->routeIs('filament.admin.pages.dashboard') || request()->routeIs('*.index');
    @endphp

    @if (!$isListOrDashboard)
        <button type="button" class="bd-back-btn"
            onclick="(function(){ if (document.referrer && document.referrer.includes(window.location.host)) { history.back(); } else { window.location.href = '{{ \Filament\Facades\Filament::getUrl() }}'; } })()">
            <x-heroicon-o-arrow-left class="bd-bn-icon" />
            <span>Kembali</span>
        </button>
    @endif

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

        <button type="button" class="bd-bn-item" x-on:click="menuOpen = ! menuOpen">
            <x-heroicon-o-bars-3 class="bd-bn-icon" />
            <span>Menu</span>
        </button>
    </nav>
</div>
