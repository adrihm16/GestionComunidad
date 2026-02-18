{{-- Bottom Navigation Bar - Eco-Tech Community Manager --}}
<nav class="fixed bottom-0 left-0 right-0 z-50 bg-white dark:bg-[#0f1f12] border-t border-gray-100 dark:border-emerald-900/30"
    style="box-shadow: 0 -2px 12px rgba(0,0,0,0.06);" id="bottom-nav">
    <div class="flex items-center justify-center gap-6 px-5 py-2 max-w-screen-xl mx-auto">
        {{-- Inicio Button --}}
        <a href="{{ url('/') }}" id="bottom-nav-inicio" class="group flex items-center justify-center"
            aria-label="Inicio">
            <div class="flex items-center justify-center w-11 h-11 rounded-xl bg-primary shadow-lg
                        transition-all duration-300 group-hover:scale-110 group-hover:shadow-xl
                        group-hover:shadow-primary/30 active:scale-95">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                </svg>
            </div>
        </a>

        {{-- Noticias Button --}}
        <a href="{{ url('/noticias') }}" id="bottom-nav-noticias" class="group flex items-center justify-center"
            aria-label="Noticias">
            <div class="flex items-center justify-center w-11 h-11 rounded-xl bg-primary shadow-lg
                        transition-all duration-300 group-hover:scale-110 group-hover:shadow-xl
                        group-hover:shadow-primary/30 active:scale-95">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z" />
                </svg>
            </div>
        </a>

        {{-- Recibos Button --}}
        <a href="{{ url('/recibos') }}" id="bottom-nav-recibos" class="group flex items-center justify-center"
            aria-label="Recibos">
            <div class="flex items-center justify-center w-11 h-11 rounded-xl bg-primary shadow-lg
                        transition-all duration-300 group-hover:scale-110 group-hover:shadow-xl
                        group-hover:shadow-primary/30 active:scale-95">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 14.25l6-6m4.5-3.493V21.75l-3.75-1.5-3.75 1.5-3.75-1.5-3.75 1.5V4.757c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0111.186 0c1.1.128 1.907 1.077 1.907 2.185zM9.75 9h.008v.008H9.75V9zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm4.125 4.5h.008v.008h-.008V13.5zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                </svg>
            </div>
        </a>

        {{-- Incidencias Button --}}
        <a href="{{ url('/incidencias') }}" id="bottom-nav-incidencias" class="group flex items-center justify-center"
            aria-label="Incidencias">
            <div class="flex items-center justify-center w-11 h-11 rounded-xl bg-primary shadow-lg
                        transition-all duration-300 group-hover:scale-110 group-hover:shadow-xl
                        group-hover:shadow-primary/30 active:scale-95">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                </svg>
            </div>
        </a>

    </div>
</nav>