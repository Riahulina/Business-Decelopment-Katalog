@props(['tag', 'lead' => null, 'script' => null])
<div class="hero ph-hero">
    <div class="blob" style="width:200px;height:200px;left:-80px;top:40px"></div>
    <div class="blob" style="width:140px;height:140px;right:-40px;top:10px"></div>
    <div class="wrap" style="position:relative"><span class="tag"><x-i n="sparkle" /> {{ $tag }}</span>
        <h1>{{ $slot }}</h1>
        @if ($lead)
            <p class="lead">{{ $lead }}</p>
        @endif
        @if ($script)
            <div class="script2">{!! str_replace('|', '<br>', e($script)) !!}</div>
        @endif
    </div>
</div>
