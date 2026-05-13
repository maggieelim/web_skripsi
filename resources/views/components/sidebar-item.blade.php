@props(['route' => null, 'url' => null, 'params' => [], 'pattern' => '', 'icon', 'label'])

@php
// Normalize pattern (hindari leading slash)
$fullPattern = ltrim($pattern, '/');

$active = request()->is($fullPattern);

// Tentukan URL
if ($route) {
$link = route($route, $params);
} elseif ($url) {
$link = url($url);
} else {
$link = '#';
}
@endphp

<li class="nav-item">
    <a class="nav-link {{ $active ? 'active' : '' }}" href="{{ $link }}">
        <div
            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <i class="fas {{ $icon }} {{ $active ? 'text-white' : 'text-dark' }}" style="font-size: 13px"></i>
        </div>
        <span class="nav-link-text ms-1">{{ $label }}</span>
    </a>
</li>