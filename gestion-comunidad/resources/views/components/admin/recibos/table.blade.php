@props(['recibos'])

<div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm text-main">
            <thead class="bg-gray-50 border-b border-gray-100 text-xs uppercase text-muted font-medium">
                <tr>
                    <th class="px-6 py-4">ID</th>
                    <th class="px-6 py-4">Fecha (Mes)</th>
                    <th class="px-6 py-4">Propiedad</th>
                    <th class="px-6 py-4">Propietario</th>
                    <th class="px-6 py-4">Concepto</th>
                    <th class="px-6 py-4">Monto</th>
                    <th class="px-6 py-4">Estado</th>
                    <th class="px-6 py-4 text-right">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($recibos as $recibo)
                    <tr class="hover:bg-gray-50/50 transition-colors">
                        <td class="px-6 py-4 font-medium text-main">#{{ $recibo->id }}</td>
                        <td class="px-6 py-4 text-muted">
                            {{ $recibo->fecha_emision->locale('es')->isoFormat('MMMM YYYY') }}
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-col">
                                <span class="font-medium text-main">{{ ucfirst($recibo->inmueble->tipo) }}</span>
                                <span class="text-xs text-muted">
                                    @if(in_array($recibo->inmueble->tipo, ['garaje', 'trastero']))
                                        {{ $recibo->inmueble->piso }}
                                    @else
                                        {{ $recibo->inmueble->piso }}º {{ $recibo->inmueble->puerta }}
                                    @endif
                                </span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-col gap-1">
                                @forelse($recibo->inmueble->propietarios as $propietario)
                                    <div class="flex items-center gap-2">
                                        <span class="truncate max-w-[150px] font-medium text-main">{{ $propietario->nombre }}
                                            {{ $propietario->apellidos }}</span>
                                        @if($propietario->cargo_comunidad)
                                            <span
                                                class="px-2 py-0.5 rounded-full bg-blue-100 text-blue-700 text-[10px] font-semibold tracking-wide uppercase">
                                                {{ $propietario->cargo_comunidad }}
                                            </span>
                                        @endif
                                    </div>
                                @empty
                                    <span class="text-xs text-muted italic">Sin propietarios</span>
                                @endforelse
                            </div>
                        </td>
                        <td class="px-6 py-4 text-main">{{ $recibo->concepto }}</td>
                        <td class="px-6 py-4 font-medium text-main">{{ number_format($recibo->monto, 2) }} €</td>
                        <td class="px-6 py-4">
                            <span
                                class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium border
                                      {{ $recibo->estado === 'pagado' ? 'bg-accent/10 text-primary border-accent' : 'bg-orange-100 text-orange-700 border-orange-200' }}">
                                {{ ucfirst($recibo->estado) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                {{-- Toggle Status --}}
                                <form action="{{ route('admin.recibos.update', $recibo) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="toggle_status" value="1">
                                    <button type="submit"
                                        class="text-xs font-medium hover:underline transition-colors focus:outline-none
                                                       {{ $recibo->estado === 'pagado' ? 'text-orange-600 hover:text-orange-700' : 'text-primary hover:text-green-800' }}">
                                        {{ $recibo->estado === 'pagado' ? 'Pendiente' : 'Pagado' }}
                                    </button>
                                </form>

                                {{-- Edit Button --}}
                                <button @click="openEditModal({{ json_encode($recibo) }})"
                                    class="p-1 text-muted hover:text-blue-600 transition-colors" title="Editar precio">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                                    </svg>
                                </button>

                                {{-- Delete Button --}}
                                <form action="{{ route('admin.recibos.destroy', $recibo) }}" method="POST"
                                    onsubmit="return confirm('¿Estás seguro de que deseas eliminar este recibo?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1 text-muted hover:text-red-600 transition-colors"
                                        title="Eliminar recibo">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-6 py-8 text-center text-muted">No se encontraron recibos.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="px-6 py-4 border-t border-gray-100">
        {{ $recibos->links('vendor.pagination.simple-tailwind-custom') }}
    </div>
</div>