@props(['open'])

<div x-show="{{ $open }}" 
     style="display: none;"
     class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm p-4">
    
    <div @click.away="{{ $open }} = false"
         class="bg-white w-full max-w-sm rounded-2xl shadow-xl overflow-hidden flex flex-col">
        
        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between bg-gray-50">
            <h3 class="text-lg font-semibold text-main">Editar Precio Recibo</h3>
            <button @click="{{ $open }} = false" class="text-muted hover:text-main">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div class="p-6">
            <form :action="'/admin/recibos/' + editingRecibo.id" method="POST" id="editReciboForm">
                @csrf
                @method('PATCH')
                
                {{-- Concept Display --}}
                <div class="mb-4">
                    <label class="block text-xs uppercase text-muted font-bold mb-1">Concepto</label>
                    <p class="text-sm font-medium text-main" x-text="editingRecibo.concepto"></p>
                </div>

                {{-- Amount Input --}}
                <div>
                    <label class="block text-sm font-medium text-main mb-1.5">Nuevo Monto (€)</label>
                    <input type="number" 
                           name="monto"
                           x-model="editingRecibo.monto"
                           step="0.01"
                           required
                           class="w-full px-4 py-2.5 rounded-xl border border-gray-200 text-sm text-main focus:outline-none focus:ring-2 focus:ring-primary/30 focus:border-primary">
                </div>
            </form>
        </div>

        <div class="px-6 py-4 border-t border-gray-100 flex items-center justify-end gap-3 bg-gray-50">
            <button @click="{{ $open }} = false" 
                    type="button"
                    class="px-5 py-2.5 rounded-xl text-sm font-medium text-muted hover:bg-gray-100 transition-colors">
                Cancelar
            </button>
            <button type="submit" form="editReciboForm"
                    class="px-5 py-2.5 rounded-xl bg-primary text-white text-sm font-medium shadow-md hover:scale-105 active:scale-95 transition-all">
                Actualizar
            </button>
        </div>
    </div>
</div>
