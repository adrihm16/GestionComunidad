@props(['user', 'success' => false])

<div>
    @include('components.ui.section-title', ['title' => 'Inmuebles Asignados', 'titleClass' => 'text-lg'])
    
    @component('components.ui.card', ['hover' => false])
        {{-- Info Badge for new users --}}
        @if($user->inmuebles->count() === 0 && $success)
            <div class="flex items-center gap-3 p-3 mb-4 rounded-lg bg-blue-50 border border-blue-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-600 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
                </svg>
                <div>
                    <p class="text-sm font-semibold text-blue-900">Siguiente paso: Asigna inmuebles</p>
                    <p class="text-xs text-blue-700">Este usuario no tiene inmuebles asignados. Usa el botón de abajo para agregar uno.</p>
                </div>
            </div>
        @endif

        {{-- Current Inmuebles --}}
        @if($user->inmuebles->count() > 0)
            <div class="flex flex-col gap-3 mb-4">
                @foreach($user->inmuebles as $inmueble)
                    <div class="flex items-center justify-between p-3 rounded-lg bg-gray-50 border border-gray-100">
                        <div class="flex items-center gap-3">
                            {{-- Icon based on type --}}
                            <div class="flex items-center justify-center w-10 h-10 rounded-lg 
                                        {{ $inmueble->tipo === 'piso' ? 'bg-blue-100' : '' }}
                                        {{ $inmueble->tipo === 'local' ? 'bg-purple-100' : '' }}
                                        {{ $inmueble->tipo === 'garaje' ? 'bg-gray-100' : '' }}
                                        {{ $inmueble->tipo === 'trastero' ? 'bg-amber-100' : '' }}">
                                @if($inmueble->tipo === 'piso')
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                                    </svg>
                                @elseif($inmueble->tipo === 'local')
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 01.75-.75h3a.75.75 0 01.75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349m-16.5 11.65V9.35m0 0a3.001 3.001 0 003.75-.615A2.993 2.993 0 009.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 002.25 1.016c.896 0 1.7-.393 2.25-1.016a3.001 3.001 0 003.75.614m-16.5 0a3.004 3.004 0 01-.621-4.72L4.318 3.44A1.5 1.5 0 015.378 3h13.243a1.5 1.5 0 011.06.44l1.19 1.189a3 3 0 01-.621 4.72m-13.5 8.65h3.75a.75.75 0 00.75-.75V13.5a.75.75 0 00-.75-.75H6.75a.75.75 0 00-.75.75v3.75c0 .415.336.75.75.75z" />
                                    </svg>
                                @elseif($inmueble->tipo === 'garaje')
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.177v-.958c0-.568-.422-1.048-.987-1.106a48.554 48.554 0 00-10.026 0 1.106 1.106 0 00-.987 1.106v7.635m12-6.677v6.677m0 4.5v-4.5m0 0h-12" />
                                    </svg>
                                @else
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-amber-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
                                    </svg>
                                @endif
                            </div>

                            {{-- Inmueble Details --}}
                            <div>
                                <p class="text-sm font-semibold text-main">
                                    {{ ucfirst($inmueble->tipo) }}
                                    @if($inmueble->bloque) - Bloque {{ $inmueble->bloque }} @endif
                                </p>
                                <p class="text-xs text-muted">
                                    @if($inmueble->tipo === 'garaje' || $inmueble->tipo === 'trastero')
                                        {{ $inmueble->piso }}
                                    @else
                                        {{ $inmueble->piso }}º{{ $inmueble->puerta }}
                                    @endif
                                </p>
                            </div>
                        </div>

                        {{-- Delete Button --}}
                        <form method="POST" action="{{ route('admin.users.inmuebles.destroy', [$user, $inmueble]) }}"
                              onsubmit="return confirm('¿Eliminar este inmueble?')"
                              class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    class="p-2 rounded-lg hover:bg-red-50 transition-colors duration-200"
                                    title="Eliminar inmueble">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                                </svg>
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-sm text-muted mb-4">Este usuario no tiene inmuebles asignados.</p>
        @endif

        {{-- Add Inmueble Form (Collapsible) --}}
        <div x-data="{ open: false, tipo: '' }" class="border-t border-gray-100 pt-4">
            <button type="button" 
                    @click="open = !open"
                    class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl 
                           bg-primary text-white text-sm font-medium shadow-md
                           transition-all duration-200 hover:scale-105 active:scale-95">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
                <span x-text="open ? 'Cancelar' : 'Agregar Inmueble'"></span>
            </button>

            {{-- Form --}}
            <form method="POST" 
                  action="{{ route('admin.users.inmuebles.store', $user) }}"
                  x-show="open"
                  x-transition
                  x-data="{ submitting: false }"
                  @submit="submitting = true"
                  class="mt-4 flex flex-col gap-4">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    {{-- Tipo --}}
                    <div>
                        <label class="block text-sm font-medium text-main mb-1.5">Tipo <span class="text-red-500">*</span></label>
                        <select name="tipo" 
                                x-model="tipo"
                                required
                                class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm text-main
                                       focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary
                                       transition-all duration-200">
                            <option value="">Selecciona tipo</option>
                            <option value="piso">Piso</option>
                            <option value="local">Local</option>
                            <option value="garaje">Garaje</option>
                            <option value="trastero">Trastero</option>
                        </select>
                    </div>

                    {{-- Bloque --}}
                    <div>
                        <label class="block text-sm font-medium text-main mb-1.5">Bloque</label>
                        <input type="text" 
                               name="bloque"
                               placeholder="A, B, C..."
                               maxlength="10"
                               class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm text-main
                                      focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary
                                      transition-all duration-200">
                    </div>

                    {{-- Campos para PISO y LOCAL (Piso + Puerta separados) --}}
                    <template x-if="tipo === 'piso' || tipo === 'local'">
                        <div class="col-span-2 grid grid-cols-1 md:grid-cols-2 gap-4">
                            {{-- Piso --}}
                            <div>
                                <label class="block text-sm font-medium text-main mb-1.5">Piso <span class="text-red-500">*</span></label>
                                <input type="text" 
                                       name="piso"
                                       placeholder="1, 2, 3, B, S..."
                                       maxlength="10"
                                       required
                                       class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm text-main
                                              focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary
                                              transition-all duration-200">
                            </div>

                            {{-- Puerta --}}
                            <div>
                                <label class="block text-sm font-medium text-main mb-1.5">Puerta <span class="text-red-500">*</span></label>
                                <input type="text" 
                                       name="puerta"
                                       placeholder="A, B, 1, 2..."
                                       maxlength="10"
                                       required
                                       class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm text-main
                                              focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary
                                              transition-all duration-200">
                            </div>
                        </div>
                    </template>

                    {{-- Campos para GARAJE y TRASTERO (Solo número/letra) --}}
                    <template x-if="tipo === 'garaje' || tipo === 'trastero'">
                        <div class="col-span-2">
                            <label class="block text-sm font-medium text-main mb-1.5">
                                Número/Identificador <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   name="piso"
                                   placeholder="G1, G2, T1, T2, A, B, 1, 2..."
                                   maxlength="10"
                                   required
                                   class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm text-main
                                          focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary
                                          transition-all duration-200">
                            <p class="text-xs text-muted mt-1.5">
                                Ejemplo: G1, G2 (garajes) o T1, T2 (trasteros)
                            </p>
                            {{-- Hidden input for puerta (required by database) --}}
                            <input type="hidden" name="puerta" value="-">
                        </div>
                    </template>
                </div>

                {{-- Submit Button --}}
                <div class="flex justify-end">
                    <button type="submit" 
                            :disabled="submitting"
                            :class="submitting ? 'opacity-50 cursor-not-allowed' : 'hover:scale-105 active:scale-95'"
                            class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl 
                                   bg-emerald-600 text-white text-sm font-medium shadow-md
                                   transition-all duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                        <span x-text="submitting ? 'Guardando...' : 'Guardar Inmueble'"></span>
                    </button>
                </div>
            </form>
        </div>
    @endcomponent
</div>
