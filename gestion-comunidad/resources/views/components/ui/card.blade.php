{{--
Dual-Tone Card Component

Usage:
@component('components.ui.card', ['hover' => true])
Card content here
@endcomponent

Props (all optional):
- $cardClass : extra classes for the outer container
- $stripClass : extra classes for the green strip (e.g. 'px-4 py-2.5' for tall headers)
- $stripHeight: height class for thin strip (default: 'h-4', ignored if $stripContent set)
- $stripContent: content inside the strip (e.g. "1ºA" text). Makes strip taller & text-bearing.
- $hover : if true, adds hover lift + shadow effect (default: false)
- $bodyClass : extra classes for the body/content div (default: 'p-4')
--}}
<div class="flex flex-col rounded-2xl shadow-md overflow-hidden bg-white dark:bg-[#0f1f12] dark:shadow-emerald-950/20 w-full
            {{ isset($hover) && $hover ? 'transition-all duration-300 hover:shadow-lg hover:-translate-y-0.5' : '' }}
            {{ $cardClass ?? '' }}">

    {{-- Green Strip --}}
    @if(isset($stripContent) && $stripContent)
        <div class="bg-primary px-4 py-2.5 {{ $stripClass ?? '' }}">
            {!! $stripContent !!}
        </div>
    @else
        <div class="{{ $stripHeight ?? 'h-4' }} bg-primary w-full {{ $stripClass ?? '' }}"></div>
    @endif

    {{-- Content Body --}}
    <div class="{{ $bodyClass ?? 'p-4' }}">
        {{ $slot }}
    </div>
</div>