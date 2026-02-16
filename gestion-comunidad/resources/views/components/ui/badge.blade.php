{{-- 
    Badge / Pill Component

    Usage:
    @include('components.ui.badge', ['text' => 'Presidente', 'variant' => 'accent'])

    Props:
    - $text       : (required) the badge text
    - $variant    : (optional) 'accent' (neon green bg) | 'success' (green outline) | 'muted' (gray), default: 'accent'
    - $badgeClass : (optional) extra classes
--}}
@php
    $variants = [
        'accent'  => 'bg-accent text-primary',
        'success' => 'bg-accent/15 text-primary',
        'muted'   => 'bg-gray-100 text-muted',
    ];
    $variantClass = $variants[$variant ?? 'accent'] ?? $variants['accent'];
@endphp

<span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold shadow-sm whitespace-nowrap
             {{ $variantClass }} {{ $badgeClass ?? '' }}">
    {{ $text }}
</span>
