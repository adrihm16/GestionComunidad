@props(['open', 'inmuebles'])

<div x-show="{{ $open }}" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
    class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm p-4" style="display: none;">

    <div @click.away="{{ $open }} = false"
        class="bg-white w-full max-w-lg rounded-2xl shadow-xl overflow-hidden flex flex-col max-h-[90vh]">

        {{-- Modal Header --}}
        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between bg-gray-50">
            <h3 class="text-lg font-semibold text-main">Nuevo Recibo Manual</h3>
            <button @click="{{ $open }} = false" class="text-muted hover:text-main">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        {{-- Modal Body --}}
        <div class="p-6 overflow-y-auto">
            <form action="{{ route('admin.recibos.store') }}" method="POST" id="createReciboForm"
                class="flex flex-col gap-4">
                @csrf
                {{-- Property Selector --}}
                <div>
                    <label class="block text-sm font-medium text-main mb-1.5">Propiedad</label>
                    <select name="inmueble_id" required
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm text-main focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary">
                        <option value="">Seleccionar Propiedad...</option>
                        @foreach($inmuebles as $inmueble)
                            <option value="{{ $inmueble->id }}">
                                {{ ucfirst($inmueble->tipo) }}
                                {{ $inmueble->piso }} {{ $inmueble->puerta }} -
                                {{ $inmueble->propietarios->pluck('nombre')->implode(', ') ?: 'Sin propietarios' }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Concept --}}
                <div>
                    <label class="block text-sm font-medium text-main mb-1.5">Concepto</label>
                    <input type="text" name="concepto" value="Cuota Comunidad" required
                        class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm text-main focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    {{-- Amount --}}
                    <div>
                        <label class="block text-sm font-medium text-main mb-1.5">Monto (€)</label>
                        <input type="number" name="monto" placeholder="0.00" step="0.01" required
                            class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm text-main focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary">
                    </div>

                    {{-- Date --}}
                    <div>
                        <label class="block text-sm font-medium text-main mb-1.5">Fecha Emisión</label>
                        <input type="date" name="fecha_emision" value="{{ date('Y-m-d') }}" required
                            class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm text-main focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary">
                    </div>
                </div>

                <div class="p-3 bg-blue-50 text-blue-800 text-xs rounded-lg">
                    <span class="font-bold">Nota:</span> Se generarán automáticamente recibos para los meses restantes
                    del año actual.
                </div>

            </form>
        </div>

        {{-- Modal Footer --}}
        <div class="px-6 py-4 border-t border-gray-100 flex items-center justify-end gap-3 bg-gray-50">
            <button @click="{{ $open }} = false" type="button"
                class="px-5 py-2.5 rounded-xl text-sm font-medium text-muted hover:bg-gray-100 transition-colors">
                Cancelar
            </button>
            <button type="submit" form="createReciboForm"
                class="px-5 py-2.5 rounded-xl bg-primary text-white text-sm font-medium shadow-md hover:scale-105 active:scale-95 transition-all">
                Guardar Recibo
            </button>
        </div>

    </div>
</div>