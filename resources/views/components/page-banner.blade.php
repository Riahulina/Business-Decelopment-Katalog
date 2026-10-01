@props(['eyebrow' => 'BD', 'title' => 'Business Development'])

<section class="pgb">
    <div class="pgb-decor" aria-hidden="true">
        <svg class="i d1">
            <use href="#i-mega" />
        </svg>
        <svg class="i d2">
            <use href="#i-chart" />
        </svg>
        <svg class="i d3">
            <use href="#i-target" />
        </svg>
        <svg class="i d4">
            <use href="#i-bulb" />
        </svg>
        <svg class="i d5">
            <use href="#i-cart" />
        </svg>
        <svg class="i d6">
            <use href="#i-link" />
        </svg>
        <svg class="i d7">
            <use href="#i-users" />
        </svg>
        <svg class="i d8">
            <use href="#i-phone" />
        </svg>
        <svg class="i d9">
            <use href="#i-check" />
        </svg>
        <svg class="i d10 sp">
            <use href="#i-sparkle" />
        </svg>
        <svg class="i d11 sp">
            <use href="#i-sparkle" />
        </svg>
        <svg class="i d12 sp">
            <use href="#i-sparkle" />
        </svg>
    </div>

    <div class="pgb-caption">
        <span>{{ $eyebrow }}</span>
        <h1>{{ $title }}</h1>
    </div>

    <div class="pgb-mid">
        <img src="{{ asset('images/logobd.png') }}" alt="Logo BD" class="pgb-logo">
        <span class="pgb-word">BUSINESS<br>DEVELOPMENT</span>
    </div>

    <div class="pgb-divider"></div>

    <div class="pgb-head">
        <h2>Connecting<br>Opportunities,<br>Growing Together</h2>
        <div class="pgb-rule"></div>
        <p>Bersama membuka peluang, tumbuh untuk masa depan</p>
    </div>
</section>
