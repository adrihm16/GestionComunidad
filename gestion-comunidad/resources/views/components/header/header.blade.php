{{-- App Header - Eco-Tech Community Manager --}}
<header class="sticky top-0 z-50 w-full bg-white border-b border-gray-100"
        style="box-shadow: 0 1px 8px rgba(0,0,0,0.06);">
    <div class="flex items-center justify-between px-5 py-3 max-w-screen-xl mx-auto">

        {{-- Left: User avatar + name --}}
        <a href="{{ url('/') }}" class="flex items-center gap-3 group" id="header-user-link">
            {{-- Avatar circle with user icon --}}
            <div class="relative flex items-center justify-center w-10 h-10 rounded-full border-2 border-main
                        transition-all duration-300 group-hover:border-primary group-hover:shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-main transition-colors duration-300 group-hover:text-primary"
                     fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                </svg>
            </div>
            <span class="text-main font-medium text-base transition-colors duration-300 group-hover:text-primary">
                Usuario
            </span>
        </a>

        {{-- Right: Action icons --}}
        <nav class="flex items-center gap-4" id="header-nav-actions">
            {{-- Hamburger Menu Button --}}
            <button type="button" id="header-menu-btn"
                    class="relative flex items-center justify-center w-10 h-10 rounded-xl
                           transition-all duration-300 hover:bg-primary/10 hover:shadow-sm
                           focus:outline-none focus:ring-2 focus:ring-primary/30"
                    aria-label="Menú de navegación">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-main"
                     fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
            </button>

            {{-- Notification Bell --}}
            <button type="button" id="header-bell-btn"
                    class="relative flex items-center justify-center w-10 h-10 rounded-xl
                           transition-all duration-300 hover:bg-primary/10 hover:shadow-sm
                           focus:outline-none focus:ring-2 focus:ring-primary/30"
                    aria-label="Notificaciones">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-main"
                     fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                </svg>
                {{-- Notification dot --}}
                <span class="absolute top-1.5 right-1.5 flex h-2.5 w-2.5">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-accent opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-accent"></span>
                </span>
            </button>
        </nav>
    </div>

    {{-- Mobile Slide-Down Menu --}}
    <nav id="header-mobile-menu"
         class="hidden border-t border-gray-100 bg-white"
         style="box-shadow: inset 0 2px 6px rgba(0,0,0,0.03);">
        <div class="flex flex-col px-5 py-3 gap-1">
            <a href="{{ url('/') }}"
               class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-main font-medium text-sm
                      transition-all duration-200 hover:bg-primary/10 hover:text-primary">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                </svg>
                Inicio
            </a>
            <a href="{{ url('/vecinos') }}"
               class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-main font-medium text-sm
                      transition-all duration-200 hover:bg-primary/10 hover:text-primary">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                </svg>
                Vecinos
            </a>
            <a href="{{ url('/suma') }}"
               class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-main font-medium text-sm
                      transition-all duration-200 hover:bg-primary/10 hover:text-primary">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M15.75 15.75V18m-7.5-6.75h.008v.008H8.25v-.008zm0 2.25h.008v.008H8.25V13.5zm0 2.25h.008v.008H8.25v-.008zm0 2.25h.008v.008H8.25V18zm2.498-6.75h.007v.008h-.007v-.008zm0 2.25h.007v.008h-.007V13.5zm0 2.25h.007v.008h-.007v-.008zm0 2.25h.007v.008h-.007V18zm2.504-6.75h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V13.5zm0 2.25h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V18zm2.498-6.75h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V13.5zM8.25 6h7.5v2.25h-7.5V6zM12 2.25c-1.892 0-3.758.11-5.593.322C5.307 2.7 4.5 3.65 4.5 4.757V19.5a2.25 2.25 0 002.25 2.25h10.5a2.25 2.25 0 002.25-2.25V4.757c0-1.108-.806-2.057-1.907-2.185A48.507 48.507 0 0012 2.25z" />
                </svg>
                Suma
            </a>
        </div>
    </nav>
</header>

{{-- Menu toggle script --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const menuBtn = document.getElementById('header-menu-btn');
        const mobileMenu = document.getElementById('header-mobile-menu');

        if (menuBtn && mobileMenu) {
            menuBtn.addEventListener('click', function () {
                mobileMenu.classList.toggle('hidden');
                // Smooth slide animation
                if (!mobileMenu.classList.contains('hidden')) {
                    mobileMenu.style.maxHeight = mobileMenu.scrollHeight + 'px';
                    mobileMenu.style.opacity = '1';
                } else {
                    mobileMenu.style.maxHeight = '0';
                    mobileMenu.style.opacity = '0';
                }
            });
        }
    });
</script>
