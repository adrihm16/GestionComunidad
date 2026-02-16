{{-- 
    Section Title Component

    Usage:
    @include('components.ui.section-title', ['title' => 'Últimas noticias'])

    Props:
    - $title     : (required) the title text
    - $titleClass: (optional) extra classes
--}}
<h2 class="font-poppins font-semibold text-lg text-black mb-2 {{ $titleClass ?? '' }}">
    {{ $title }}
</h2>
