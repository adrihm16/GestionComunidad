@extends('layouts.admin')

@section('title', 'Balance Financiero - Panel Admin')

@section('content')
{{-- Wrap EVERYTHING in one x-data scope so the modal and tabs can be controlled correctly --}}
<div x-data="{ modalOpen: false, activeTab: 'gastos' }" class="flex flex-col gap-6">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            @include('components.ui.section-title', ['title' => 'Balance Financiero', 'titleClass' => 'text-xl mb-0'])
            <p class="text-sm text-muted -mt-3">Ingresos por cuotas y gastos de la comunidad</p>
        </div>

        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
            {{-- Filter form (Year & Month) --}}
            <form method="GET" action="{{ route('admin.balance.index') }}" class="flex items-center gap-2">
                {{-- Year selector --}}
                <select name="year" onchange="this.form.submit()"
                    class="w-full sm:w-auto px-4 py-2.5 rounded-xl border border-gray-200 bg-white text-sm text-main
                           focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary">
                    @foreach($years as $y)
                        <option value="{{ $y }}" {{ $year == $y ? 'selected' : '' }}>{{ $y }}</option>
                    @endforeach
                </select>

                {{-- Month selector --}}
                <select name="month" onchange="this.form.submit()"
                    class="w-full sm:w-auto px-4 py-2.5 rounded-xl border border-gray-200 bg-white text-sm text-main
                           focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary">
                    <option value="">Todos los meses</option>
                    @foreach($meses as $num => $nombre)
                        <option value="{{ $num }}" {{ $month == $num ? 'selected' : '' }}>{{ $nombre }}</option>
                    @endforeach
                </select>
            </form>

            {{-- New gasto button --}}
            <button @click="modalOpen = true"
                class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-primary text-white
                       text-sm font-medium shadow-md transition-all duration-200 hover:scale-105 active:scale-95">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                Nuevo Gasto
            </button>
        </div>
    </div>

    {{-- Success message --}}
    @if(session('success'))
        <div class="flex items-center gap-3 p-4 rounded-xl bg-emerald-50 border border-emerald-100 text-emerald-700">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <p class="text-sm font-medium">{{ session('success') }}</p>
        </div>
    @endif

    {{-- SUMMARY CARDS --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">

        {{-- Ingresos --}}
        @component('components.ui.card', ['hover' => false])
            <div class="flex items-center gap-4">
                <div class="flex items-center justify-center w-12 h-12 rounded-xl bg-emerald-50 flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941" />
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-muted uppercase font-medium tracking-wide">Ingresos {{ $year }}</p>
                    <p class="text-2xl font-bold text-emerald-600 mt-0.5">{{ number_format($totalIngresos, 2, ',', '.') }} €</p>
                    <p class="text-xs text-muted mt-0.5">Cuotas cobradas</p>
                </div>
            </div>
        @endcomponent

        {{-- Gastos --}}
        @component('components.ui.card', ['hover' => false])
            <div class="flex items-center gap-4">
                <div class="flex items-center justify-center w-12 h-12 rounded-xl bg-red-50 flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6L9 12.75l4.286-4.286a11.948 11.948 0 014.306 6.43l.776 2.898m0 0l3.182-5.511m-3.182 5.51l-5.511-3.181" />
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-muted uppercase font-medium tracking-wide">Gastos {{ $year }}</p>
                    <p class="text-2xl font-bold text-red-500 mt-0.5">{{ number_format($totalGastos, 2, ',', '.') }} €</p>
                    <p class="text-xs text-muted mt-0.5">Total registrado</p>
                </div>
            </div>
        @endcomponent

        {{-- Balance Neto --}}
        @component('components.ui.card', ['hover' => false])
            <div class="flex items-center gap-4">
                <div class="flex items-center justify-center w-12 h-12 rounded-xl flex-shrink-0
                    {{ $balanceNeto >= 0 ? 'bg-primary/10' : 'bg-orange-50' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 {{ $balanceNeto >= 0 ? 'text-primary' : 'text-orange-500' }}"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 3v17.25m0 0c-1.472 0-2.882.265-4.185.75M12 20.25c1.472 0 2.882.265 4.185.75M18.75 4.97A48.416 48.416 0 0012 4.5c-2.291 0-4.545.16-6.75.47m13.5 0c1.01.143 2.01.317 3 .52m-3-.52l2.62 10.726c.122.499-.106 1.028-.589 1.202a5.988 5.988 0 01-2.031.352 5.988 5.988 0 01-2.031-.352c-.483-.174-.711-.703-.59-1.202L18.75 4.971zm-16.5.52c.99-.203 1.99-.377 3-.52m0 0l2.62 10.726c.122.499-.106 1.028-.589 1.202a5.989 5.989 0 01-2.031.352 5.989 5.989 0 01-2.031-.352c-.483-.174-.711-.703-.59-1.202L5.25 5.491z" />
                    </svg>
                </div>
                <div>
                    <p class="text-xs text-muted uppercase font-medium tracking-wide">Balance Neto {{ $year }}</p>
                    <p class="text-2xl font-bold mt-0.5 {{ $balanceNeto >= 0 ? 'text-primary' : 'text-orange-500' }}">
                        {{ $balanceNeto >= 0 ? '+' : '' }}{{ number_format($balanceNeto, 2, ',', '.') }} €
                    </p>
                    <p class="text-xs text-muted mt-0.5">{{ $balanceNeto >= 0 ? 'Superávit' : 'Déficit' }}</p>
                </div>
            </div>
        @endcomponent

    </div>

    {{-- CUENTA BANCARIA (Solo Admin) --}}
    <div x-data="{ editingIban: false, iban: '{{ $iban }}' }">
        @component('components.ui.card', ['hover' => false])
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div class="flex items-center gap-4">
                    <div class="flex items-center justify-center w-12 h-12 rounded-xl bg-blue-50 flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 8.25h19.5M2.25 9h19.5m-16.5 5.25h6m-6 2.25h3m-3.75 3h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-xs text-muted uppercase font-medium tracking-wide">Cuenta Bancaria de la Comunidad</p>
                        
                        {{-- Read mode --}}
                        <div x-show="!editingIban" class="flex items-center gap-2 mt-0.5">
                            <p class="text-lg font-bold text-main" x-text="iban || 'No configurada'"></p>
                            <button @click="editingIban = true" class="p-1 text-muted hover:text-primary transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                                </svg>
                            </button>
                        </div>

                        {{-- Edit mode --}}
                        <div x-show="editingIban" x-cloak class="mt-1">
                            <form action="{{ route('admin.balance.settings.update') }}" method="POST" class="flex flex-wrap items-center gap-2">
                                @csrf
                                <input type="hidden" name="key" value="iban">
                                <input type="text" name="value" x-model="iban" 
                                    class="px-3 py-1.5 rounded-lg border border-gray-200 text-sm focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none min-w-[300px]"
                                    placeholder="Introduce el IBAN de la comunidad">
                                <div class="flex items-center gap-1">
                                    <button type="submit" class="p-1.5 bg-primary text-white rounded-lg hover:scale-105 active:scale-95 transition-all">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                        </svg>
                                    </button>
                                    <button type="button" @click="editingIban = false; iban = '{{ $iban }}'" class="p-1.5 bg-gray-100 text-muted rounded-lg hover:bg-gray-200 transition-colors">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                        </svg>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="hidden sm:block text-right">
                    <p class="text-[10px] text-muted uppercase font-bold tracking-widest">Acceso Restringido</p>
                    <p class="text-xs text-muted mt-0.5">Solo visible para administradores</p>
                </div>
            </div>
        @endcomponent
    </div>

    {{-- TABS FOR GASTOS / INGRESOS --}}
    <div>
        <div class="flex items-center gap-6 border-b border-gray-100 mb-4 px-1">
            <button @click="activeTab = 'gastos'"
                :class="activeTab === 'gastos' ? 'border-primary text-primary' : 'border-transparent text-muted hover:text-main'"
                class="pb-3 border-b-2 font-semibold transition-all text-sm outline-none focus:outline-none">
                Gastos Registrados ({{ count($gastos) }})
            </button>
            <button @click="activeTab = 'ingresos'"
                :class="activeTab === 'ingresos' ? 'border-primary text-primary' : 'border-transparent text-muted hover:text-main'"
                class="pb-3 border-b-2 font-semibold transition-all text-sm outline-none focus:outline-none">
                Ingresos por Cuotas ({{ count($ingresos) }})
            </button>
        </div>

        {{-- GASTOS TAB --}}
        <div x-show="activeTab === 'gastos'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform translate-x-2">
            @forelse($gastos as $gasto)
                @component('components.ui.card', ['hover' => false])
                    <div class="flex flex-col sm:flex-row sm:items-center gap-3">

                        {{-- Icon by category --}}
                        <div class="flex items-center justify-center w-10 h-10 rounded-xl bg-gray-50 flex-shrink-0">
                            @switch($gasto->categoria)
                                @case('mantenimiento')
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17L17.25 21A2.652 2.652 0 0021 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 11-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 004.486-6.336l-3.276 3.277a3.004 3.004 0 01-2.25-2.25l3.276-3.276a4.5 4.5 0 00-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437l1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008z" />
                                    </svg>
                                    @break
                                @case('limpieza')
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-emerald-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.75 3.104v5.714a2.25 2.25 0 01-.659 1.591L5 14.5M9.75 3.104c-.251.023-.501.05-.75.082m.75-.082a24.301 24.301 0 014.5 0m0 0v5.714c0 .597.237 1.17.659 1.591L19.8 15.3M14.25 3.104c.251.023.501.05.75.082M19.8 15.3l-1.57.393A9.065 9.065 0 0112 15a9.065 9.065 0 00-6.23-.693L5 14.5m14.8.8l1.402 1.402c1.232 1.232.65 3.318-1.067 3.611A48.309 48.309 0 0112 21c-2.773 0-5.491-.235-8.135-.687-1.718-.293-2.3-2.379-1.067-3.61L5 14.5" />
                                    </svg>
                                    @break
                                @case('obras')
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008zm0 3h.008v.008h-.008v-.008z" />
                                    </svg>
                                    @break
                                @default
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-muted" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" />
                                    </svg>
                            @endswitch
                        </div>

                        {{-- Details --}}
                        <div class="flex-1 min-w-0">
                            <div class="flex flex-wrap items-center gap-2 mb-0.5">
                                <p class="font-semibold text-sm text-main">{{ $gasto->concepto }}</p>
                                <span class="px-2 py-0.5 rounded-full text-[11px] font-semibold {{ \App\Models\Gasto::categoriaBadgeColor($gasto->categoria) }}">
                                    {{ \App\Models\Gasto::categoriaLabel($gasto->categoria) }}
                                </span>
                            </div>
                            <div class="flex flex-wrap gap-3 text-xs text-muted">
                                <span class="flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25" />
                                    </svg>
                                    {{ $gasto->fecha->format('d/m/Y') }}
                                </span>
                                <span class="flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0" />
                                    </svg>
                                    {{ $gasto->registradoPor->nombre ?? 'Admin' }}
                                </span>
                                @if($gasto->descripcion)
                                    <span class="truncate max-w-xs">{{ Str::limit($gasto->descripcion, 60) }}</span>
                                @endif
                            </div>
                        </div>

                        {{-- Amount + Actions --}}
                        <div class="flex items-center gap-4 sm:ml-4">
                            <p class="text-lg font-bold text-red-500 whitespace-nowrap">
                                -{{ number_format($gasto->monto, 2, ',', '.') }} €
                            </p>

                            @if($gasto->adjunto_url)
                                <a href="{{ $gasto->adjunto_url }}" target="_blank"
                                    class="p-2 rounded-lg text-muted hover:text-primary hover:bg-primary/5 transition-colors"
                                    title="Ver factura adjunta">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M18.375 12.739l-7.693 7.693a4.5 4.5 0 01-6.364-6.364l10.94-10.94A3 3 0 1119.5 7.372L8.552 18.32m.009-.01l-.01.01m5.699-9.941l-7.81 7.81a1.5 1.5 0 002.112 2.13" />
                                    </svg>
                                </a>
                            @endif

                            <form action="{{ route('admin.balance.destroy', $gasto) }}" method="POST"
                                onsubmit="return confirm('¿Eliminar este gasto?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="p-2 rounded-lg text-muted hover:text-red-500 hover:bg-red-50 transition-colors"
                                    title="Eliminar gasto">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                    </svg>
                                </button>
                            </form>
                        </div>

                    </div>
                @endcomponent
            @empty
                <div class="flex flex-col items-center justify-center py-12 text-center">
                    <div class="w-14 h-14 rounded-full bg-gray-100 flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-muted" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <p class="text-sm font-medium text-main">No hay gastos en {{ $year }}</p>
                    <p class="text-xs text-muted mt-1">Pulsa "Nuevo Gasto" para registrar el primero</p>
                </div>
            @endforelse
        </div>

        {{-- INGRESOS TAB --}}
        <div x-show="activeTab === 'ingresos'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 transform translate-x-2">
            @forelse($ingresos as $ingreso)
                @component('components.ui.card', ['hover' => false])
                    <div class="flex flex-col sm:flex-row sm:items-center gap-3">

                        {{-- Icon for Income --}}
                        <div class="flex items-center justify-center w-10 h-10 rounded-xl bg-emerald-50 flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941" />
                            </svg>
                        </div>

                        {{-- Details --}}
                        <div class="flex-1 min-w-0">
                            <div class="flex flex-wrap items-center gap-2 mb-0.5">
                                <p class="font-semibold text-sm text-main uppercase">{{ $ingreso->concepto }}</p>
                                <span class="px-2 py-0.5 rounded-full text-[11px] font-semibold bg-emerald-100 text-emerald-700">
                                    Cuota Cobrada
                                </span>
                            </div>
                            <div class="flex flex-wrap gap-3 text-xs text-muted">
                                <span class="flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25" />
                                    </svg>
                                    {{ $ingreso->fecha_pago ? $ingreso->fecha_pago->format('d/m/Y') : $ingreso->updated_at->format('d/m/Y') }}
                                </span>
                                <span class="flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0" />
                                    </svg>
                                    {{ $ingreso->inmueble->propietarios->pluck('nombre')->implode(', ') ?: 'Usuario' }}
                                </span>
                                <span class="flex items-center gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21" />
                                    </svg>
                                    {{ $ingreso->inmueble->bloque ? 'Bl '. $ingreso->inmueble->bloque : '' }} {{ $ingreso->inmueble->piso }}{{ $ingreso->inmueble->puerta }}
                                </span>
                            </div>
                        </div>

                        {{-- Amount --}}
                        <div class="sm:ml-4">
                            <p class="text-lg font-bold text-emerald-600 whitespace-nowrap">
                                +{{ number_format($ingreso->monto, 2, ',', '.') }} €
                            </p>
                        </div>

                    </div>
                @endcomponent
            @empty
                <div class="flex flex-col items-center justify-center py-12 text-center">
                    <div class="w-14 h-14 rounded-full bg-gray-100 flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-muted" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <p class="text-sm font-medium text-main">No hay ingresos registrados en {{ $year }}</p>
                </div>
            @endforelse
        </div>
    </div>

    {{-- ============================= --}}
    {{-- MODAL: Nuevo Gasto            --}}
    {{-- ============================= --}}
    {{-- The modal MUST be inside the same x-data div as the button --}}
    <div x-show="modalOpen"
         x-cloak
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm p-4">

        <div @click.away="modalOpen = false"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95"
             class="bg-white w-full max-w-lg rounded-2xl shadow-2xl overflow-hidden flex flex-col max-h-[90vh]">

            {{-- Green strip --}}
            <div class="h-1.5 bg-primary w-full"></div>

            {{-- Modal header --}}
            <div class="px-6 py-4 flex items-center justify-between border-b border-gray-100">
                <div>
                    <h3 class="text-base font-semibold text-main">Registrar nuevo gasto</h3>
                    <p class="text-xs text-muted mt-0.5">Rellena los datos del gasto de la comunidad</p>
                </div>
                <button @click="modalOpen = false"
                    class="p-1.5 rounded-lg text-muted hover:bg-gray-100 hover:text-main transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            {{-- Modal body --}}
            <form action="{{ route('admin.balance.store') }}" method="POST" enctype="multipart/form-data"
                  class="p-6 overflow-y-auto flex flex-col gap-5">
                @csrf

                {{-- Concepto --}}
                <div>
                    <label class="block text-sm font-medium text-main mb-1.5">
                        Concepto <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="concepto" required
                        placeholder="Ej: Reparación ascensor, Limpieza portal..."
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm text-main
                               focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all">
                </div>

                {{-- Categoría + Monto en fila --}}
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-main mb-1.5">
                            Categoría <span class="text-red-500">*</span>
                        </label>
                        <select name="categoria" required
                            class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm text-main
                                   focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all">
                            <option value="mantenimiento">🔧 Mantenimiento</option>
                            <option value="limpieza">🧹 Limpieza</option>
                            <option value="suministros">💡 Suministros</option>
                            <option value="obras">🏗️ Obras</option>
                            <option value="otro" selected>📦 Otro</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-main mb-1.5">
                            Importe (€) <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input type="number" name="monto" required min="0.01" step="0.01"
                                placeholder="0,00"
                                class="w-full pl-4 pr-10 py-2.5 rounded-xl border border-gray-200 text-sm text-main
                                       focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all">
                            <span class="absolute right-3 top-2.5 text-sm text-muted font-medium">€</span>
                        </div>
                    </div>
                </div>

                {{-- Fecha --}}
                <div>
                    <label class="block text-sm font-medium text-main mb-1.5">
                        Fecha del gasto <span class="text-red-500">*</span>
                    </label>
                    <input type="date" name="fecha" required value="{{ date('Y-m-d') }}"
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm text-main
                               focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all">
                </div>

                {{-- Descripción --}}
                <div>
                    <label class="block text-sm font-medium text-main mb-1.5">
                        Descripción <span class="text-xs text-muted">(opcional)</span>
                    </label>
                    <textarea name="description" rows="3"
                        placeholder="Detalla el motivo del gasto, proveedor, etc."
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm text-main resize-none
                               focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary transition-all"></textarea>
                </div>

                {{-- Adjunto --}}
                <div>
                    <label class="block text-sm font-medium text-main mb-1.5">
                        Factura o justificante <span class="text-xs text-muted">(PDF o imagen, máx. 5 MB)</span>
                    </label>
                    <label class="flex flex-col items-center justify-center w-full h-24 border-2 border-dashed border-gray-200 rounded-xl cursor-pointer
                                  hover:border-primary/40 hover:bg-primary/5 transition-all group">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-muted group-hover:text-primary transition-colors mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                        </svg>
                        <span class="text-xs text-muted group-hover:text-primary transition-colors">Haz clic para subir archivo</span>
                        <span class="text-[10px] text-muted mt-0.5">PDF, JPG, PNG o WEBP</span>
                        <input type="file" name="adjunto" accept=".pdf,.jpg,.jpeg,.png,.webp" class="hidden">
                    </label>
                </div>

                {{-- Footer --}}
                <div class="flex items-center justify-end gap-3 pt-2 border-t border-gray-100">
                    <button type="button" @click="modalOpen = false"
                        class="px-5 py-2.5 rounded-xl text-sm font-medium text-muted hover:bg-gray-100 transition-colors">
                        Cancelar
                    </button>
                    <button type="submit"
                        class="px-5 py-2.5 rounded-xl bg-primary text-white text-sm font-medium shadow-md
                               transition-all duration-200 hover:scale-105 active:scale-95 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Guardar Gasto
                    </button>
                </div>
            </form>

        </div>
    </div>

</div>{{-- end x-data wrapper --}}
@endsection
