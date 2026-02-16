{{-- 
    Search Bar Component

    Usage:
    @include('components.ui.search-bar', ['action' => url('/vecinos'), 'name' => 'search'])

    Props:
    - $action      : (required) form action URL
    - $name        : (optional) input name, default: 'search'
    - $placeholder : (optional) placeholder text, default: 'Buscar'
    - $value       : (optional) current value, default: request($name)
    - $id          : (optional) input ID
--}}
@php
    $inputName = $name ?? 'search';
    $inputValue = $value ?? request($inputName);
    $inputId = $id ?? ($inputName . '-input');
@endphp

<form action="{{ $action }}" method="GET" id="{{ $inputId }}-form">
    <div class="flex items-center rounded-2xl bg-white shadow-md overflow-hidden border border-gray-100
                focus-within:ring-2 focus-within:ring-primary/30 focus-within:border-primary/30
                transition-all duration-300">
        <input type="text"
               name="{{ $inputName }}"
               id="{{ $inputId }}"
               value="{{ $inputValue }}"
               placeholder="{{ $placeholder ?? 'Buscar' }}"
               class="flex-1 px-4 py-3 bg-transparent text-sm text-main placeholder-muted
                      font-poppins border-none focus:outline-none focus:ring-0">
        <button type="submit" class="px-4 py-3 hover:bg-primary/5 transition-colors" aria-label="Buscar">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-main" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
            </svg>
        </button>
    </div>
</form>
