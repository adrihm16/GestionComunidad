@props(['anio', 'mes', 'search'])

<form action="{{ route('admin.recibos.index') }}" method="GET" class="flex flex-col lg:flex-row gap-3 w-full lg:w-auto">
    
    {{-- Year Filter --}}
    <select name="anio" onchange="this.form.submit()" 
            class="w-full lg:w-auto px-4 py-2.5 rounded-xl border border-gray-200 bg-white text-sm text-main focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary">
        <option value="">Todos los años</option>
        @php
            $currentYear = date('Y');
            $years = range($currentYear - 2, $currentYear + 2);
        @endphp
        @foreach($years as $year)
            <option value="{{ $year }}" {{ $anio == $year ? 'selected' : '' }}>{{ $year }}</option>
        @endforeach
    </select>

    {{-- Month Filter --}}
    <select name="mes" onchange="this.form.submit()" 
            class="w-full lg:w-auto px-4 py-2.5 rounded-xl border border-gray-200 bg-white text-sm text-main focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary">
        <option value="">Todos los meses</option>
        @foreach(range(1, 12) as $m)
            @php 
                $date = \Carbon\Carbon::create(null, $m, 1);
                $val = $m; 
                $label = ucfirst($date->locale('es')->monthName);
            @endphp
            <option value="{{ $val }}" {{ $mes == $val ? 'selected' : '' }}>{{ $label }}</option>
        @endforeach
    </select>

    {{-- Search Bar --}}
    <div class="relative w-full lg:w-auto">
        <input type="text" 
               name="search"
               value="{{ $search }}"
               placeholder="Buscar vecino, propiedad o concepto..." 
               class="w-full lg:w-64 px-4 py-2.5 pl-10 rounded-xl border border-gray-200 bg-white text-sm text-main focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-muted absolute left-3 top-2.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
        </svg>
    </div>

    {{-- Submit button for search (optional if Enter works, but good for UX) --}}
    <button type="submit" class="hidden">Buscar</button>
</form>
