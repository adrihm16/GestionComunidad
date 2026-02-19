<div class="flex items-center justify-between">
    @include('components.ui.section-title', ['title' => 'Gestión de Usuarios', 'titleClass' => 'text-xl mb-0'])
    
    <a href="{{ route('admin.users.create') }}" 
       class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-primary text-white text-sm font-medium shadow-md
              transition-all duration-200 hover:scale-105 active:scale-95">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
        </svg>
        Nuevo Usuario
    </a>
</div>
