{{-- Admin Sidebar --}}
<aside class="fixed left-0 top-[65px] bottom-0 z-30 w-64 bg-white border-r border-gray-100 flex flex-col transition-transform duration-300 ease-in-out"
       :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
       style="height: calc(100vh - 65px); overflow-y: auto;">
    
    <div class="flex items-center justify-between p-6">
        <div>
            <h2 class="text-xl font-bold text-primary">Panel Admin</h2>
            <p class="text-xs text-muted mt-1">Gestión Comunidad</p>
        </div>
        
        {{-- Close Button --}}
        <button @click="sidebarOpen = false" 
                class="p-1 rounded-lg hover:bg-gray-100 text-muted hover:text-main transition-colors flex"
                title="Cerrar menú">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
            </svg>
        </button>
    </div>

    <nav class="flex-1 px-4 space-y-2 pb-6">
        <a href="{{ route('admin.users.index') }}" 
           class="flex items-center gap-3 px-4 py-3 rounded-xl transition-colors duration-200
                  {{ request()->routeIs('admin.users.*') ? 'bg-primary/10 text-primary font-medium' : 'text-main hover:bg-gray-50' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
            </svg>
            Usuarios
        </a>

        <a href="{{ route('admin.recibos.index') }}" 
           class="flex items-center gap-3 px-4 py-3 rounded-xl transition-colors duration-200
                  {{ request()->routeIs('admin.recibos.*') ? 'bg-primary/10 text-primary font-medium' : 'text-main hover:bg-gray-50' }}">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
            </svg>
            Recibos
        </a>

        {{-- Future admin links can be added here --}}
    </nav>

    <div class="p-4 border-t border-gray-100 bg-white sticky bottom-0">
        <a href="{{ route('inicio') }}" class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-muted hover:text-main transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 15L3 9m0 0l6-6M3 9h12a6 6 0 010 12h-3" />
            </svg>
            Volver a la App
        </a>
    </div>
</aside>
