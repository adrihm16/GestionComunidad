{{-- App Header - Eco-Tech Community Manager --}}
<header class="sticky top-0 z-50 w-full bg-white border-b border-gray-100"
    style="box-shadow: 0 1px 8px rgba(0,0,0,0.06);">
    <div class="flex items-center justify-between px-5 py-3 max-w-screen-xl mx-auto">

        {{-- Left: User avatar + name + dropdown --}}
        <div class="relative" id="user-dropdown-container">
            <button type="button" id="user-dropdown-btn" class="flex items-center gap-3 group focus:outline-none"
                aria-label="Menú de usuario" aria-expanded="false">
                {{-- Avatar circle with user icon --}}
                <div class="relative flex items-center justify-center w-10 h-10 rounded-full border-2 border-main
                            transition-all duration-300 group-hover:border-primary group-hover:shadow-md">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-5 h-5 text-main transition-colors duration-300 group-hover:text-primary" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                    </svg>
                </div>
                <span class="text-main font-medium text-base transition-colors duration-300 group-hover:text-primary">
                    {{ Auth::check() ? Auth::user()->nombre : 'Usuario' }}
                </span>
                {{-- Chevron --}}
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-muted transition-transform duration-200"
                    id="user-dropdown-chevron" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                </svg>
            </button>

            {{-- Dropdown menu --}}
            <div id="user-dropdown-menu" class="hidden absolute left-0 top-full mt-2 w-52 bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden z-50
                        opacity-0 translate-y-1 transition-all duration-200">

                {{-- Profile link --}}
                <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-main
                          hover:bg-primary/5 hover:text-primary transition-colors duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    Mi Perfil
                </a>

                {{-- Admin Panel (only for admin users) --}}
                @if(Auth::check() && Auth::user()->rol_sistema === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-purple-600
                                               hover:bg-purple-50 transition-colors duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527a1.125 1.125 0 011.45.12l.773.774c.39.389.44 1.002.12 1.45l-.527.737c-.25.35-.272.806-.107 1.204.165.397.505.71.93.78l.893.15c.543.09.94.56.94 1.109v1.094c0 .55-.397 1.02-.94 1.11l-.893.149c-.425.07-.765.383-.93.78-.165.398-.143.854.107 1.204l.527.738c.32.447.269 1.06-.12 1.45l-.774.773a1.125 1.125 0 01-1.449.12l-.738-.527c-.35-.25-.806-.272-1.203-.107-.397.165-.71.505-.781.929l-.149.894c-.09.542-.56.94-1.11.94h-1.094c-.55 0-1.019-.398-1.11-.94l-.148-.894c-.071-.424-.384-.764-.781-.93-.398-.164-.854-.142-1.204.108l-.738.527c-.447.32-1.06.269-1.45-.12l-.773-.774a1.125 1.125 0 01-.12-1.45l.527-.737c.25-.35.273-.806.108-1.204-.165-.397-.505-.71-.93-.78l-.894-.15c-.542-.09-.94-.56-.94-1.109v-1.094c0-.55.398-1.02.94-1.11l.894-.149c.424-.07.765-.383.93-.78.165-.398.143-.854-.107-1.204l-.527-.738a1.125 1.125 0 01.12-1.45l.773-.773a1.125 1.125 0 011.45-.12l.737.527c.35.25.807.272 1.204.107.397-.165.71-.505.78-.929l.15-.894z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        Panel Admin
                    </a>
                @endif

                {{-- Back to Home (for admins or deep pages) --}}
                <a href="{{ route('inicio') }}"
                   class="flex items-center gap-3 px-4 py-3 text-sm font-medium text-muted
                          hover:bg-primary/5 hover:text-main transition-colors duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>
                    Volver al Inicio
                </a>

                {{-- Divider --}}
                <div class="border-t border-gray-100"></div>

                {{-- Logout --}}
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center gap-3 w-full px-4 py-3 text-sm font-medium text-red-500
                                   hover:bg-red-50 transition-colors duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                        </svg>
                        Cerrar Sesión
                    </button>
                </form>
            </div>
        </div>

        {{-- Right: Action icons --}}
        <nav class="flex items-center gap-4" id="header-nav-actions">
            {{-- Hamburger Menu Button --}}
            <button type="button" id="header-menu-btn" class="relative flex items-center justify-center w-10 h-10 rounded-xl
                           transition-all duration-300 hover:bg-primary/10 hover:shadow-sm
                           focus:outline-none focus:ring-2 focus:ring-primary/30" aria-label="Menú de navegación"
                aria-expanded="false">
                {{-- Animated hamburger bars --}}
                <div class="flex flex-col justify-center items-center w-6 h-6 gap-[5px]">
                    <span id="bar-1"
                        class="block w-5 h-[2px] bg-main rounded-full transition-all duration-300 origin-center"></span>
                    <span id="bar-2" class="block w-5 h-[2px] bg-main rounded-full transition-all duration-300"></span>
                    <span id="bar-3"
                        class="block w-5 h-[2px] bg-main rounded-full transition-all duration-300 origin-center"></span>
                </div>
            </button>

            {{-- Notification Bell --}}
            <button type="button" id="header-bell-btn" class="relative flex items-center justify-center w-10 h-10 rounded-xl
                           transition-all duration-300 hover:bg-primary/10 hover:shadow-sm
                           focus:outline-none focus:ring-2 focus:ring-primary/30" aria-label="Notificaciones">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-main" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                </svg>
                {{-- Notification dot --}}
                <span class="absolute top-1.5 right-1.5 flex h-2.5 w-2.5">
                    <span
                        class="animate-ping absolute inline-flex h-full w-full rounded-full bg-accent opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-accent"></span>
                </span>
            </button>
        </nav>
    </div>

    {{-- Mobile Slide-Down Menu --}}
    <nav id="header-mobile-menu"
        class="border-t border-gray-100 bg-white overflow-hidden transition-all duration-300 ease-in-out"
        style="max-height: 0; opacity: 0; box-shadow: inset 0 2px 6px rgba(0,0,0,0.03);">
        <div class="flex flex-col px-5 py-3 gap-1">
            <a href="{{ url('/') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-main font-medium text-sm
                      transition-all duration-200 hover:bg-primary/10 hover:text-primary">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                </svg>
                Inicio
            </a>
            <a href="{{ url('/vecinos') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-main font-medium text-sm
                      transition-all duration-200 hover:bg-primary/10 hover:text-primary">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                </svg>
                Vecinos
            </a>
            <a href="{{ url('/noticias') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-main font-medium text-sm
                      transition-all duration-200 hover:bg-primary/10 hover:text-primary">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 01-2.25 2.25M16.5 7.5V18a2.25 2.25 0 002.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 002.25 2.25h13.5M6 7.5h3v3H6v-3z" />
                </svg>
                Noticias
            </a>
            <a href="{{ url('/incidencias') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-main font-medium text-sm
                      transition-all duration-200 hover:bg-primary/10 hover:text-primary">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                </svg>
                Incidencias
            </a>
            @if(Auth::check() && Auth::user()->rol_sistema === 'admin')
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-purple-600 font-medium text-sm
                                   transition-all duration-200 hover:bg-purple-50">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527a1.125 1.125 0 011.45.12l.773.774c.39.389.44 1.002.12 1.45l-.527.737c-.25.35-.272.806-.107 1.204.165.397.505.71.93.78l.893.15c.543.09.94.56.94 1.109v1.094c0 .55-.397 1.02-.94 1.11l-.893.149c-.425.07-.765.383-.93.78-.165.398-.143.854.107 1.204l.527.738c.32.447.269 1.06-.12 1.45l-.774.773a1.125 1.125 0 01-1.449.12l-.738-.527c-.35-.25-.806-.272-1.203-.107-.397.165-.71.505-.781.929l-.149.894c-.09.542-.56.94-1.11.94h-1.094c-.55 0-1.019-.398-1.11-.94l-.148-.894c-.071-.424-.384-.764-.781-.93-.398-.164-.854-.142-1.204.108l-.738.527c-.447.32-1.06.269-1.45-.12l-.773-.774a1.125 1.125 0 01-.12-1.45l.527-.737c.25-.35.273-.806.108-1.204-.165-.397-.505-.71-.93-.78l-.894-.15c-.542-.09-.94-.56-.94-1.109v-1.094c0-.55.398-1.02.94-1.11l.894-.149c.424-.07.765-.383.93-.78.165-.398.143-.854-.107-1.204l-.527-.738a1.125 1.125 0 01.12-1.45l.773-.773a1.125 1.125 0 011.45-.12l.737.527c.35.25.807.272 1.204.107.397-.165.71-.505.78-.929l.15-.894z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    Panel Admin
                </a>
            @endif
        </div>
    </nav>
</header>

{{-- Menu toggle script --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Mobile menu toggle with hamburger → X animation
        const menuBtn = document.getElementById('header-menu-btn');
        const mobileMenu = document.getElementById('header-mobile-menu');
        const bar1 = document.getElementById('bar-1');
        const bar2 = document.getElementById('bar-2');
        const bar3 = document.getElementById('bar-3');
        let menuOpen = false;

        if (menuBtn && mobileMenu) {
            menuBtn.addEventListener('click', function () {
                menuOpen = !menuOpen;
                menuBtn.setAttribute('aria-expanded', menuOpen);

                if (menuOpen) {
                    // Animate bars to X
                    bar1.style.transform = 'translateY(7px) rotate(45deg)';
                    bar2.style.opacity = '0';
                    bar2.style.transform = 'scaleX(0)';
                    bar3.style.transform = 'translateY(-7px) rotate(-45deg)';

                    // Slide menu open
                    mobileMenu.style.maxHeight = mobileMenu.scrollHeight + 'px';
                    mobileMenu.style.opacity = '1';
                } else {
                    // Animate bars back to hamburger
                    bar1.style.transform = 'translateY(0) rotate(0)';
                    bar2.style.opacity = '1';
                    bar2.style.transform = 'scaleX(1)';
                    bar3.style.transform = 'translateY(0) rotate(0)';

                    // Slide menu closed
                    mobileMenu.style.maxHeight = '0';
                    mobileMenu.style.opacity = '0';
                }
            });
        }

        // User dropdown toggle
        const dropdownBtn = document.getElementById('user-dropdown-btn');
        const dropdownMenu = document.getElementById('user-dropdown-menu');
        const chevron = document.getElementById('user-dropdown-chevron');

        if (dropdownBtn && dropdownMenu) {
            dropdownBtn.addEventListener('click', function () {
                const isOpen = !dropdownMenu.classList.contains('hidden');

                if (isOpen) {
                    dropdownMenu.classList.add('opacity-0', 'translate-y-1');
                    dropdownMenu.classList.remove('opacity-100', 'translate-y-0');
                    chevron.classList.remove('rotate-180');
                    dropdownBtn.setAttribute('aria-expanded', 'false');
                    setTimeout(() => dropdownMenu.classList.add('hidden'), 200);
                } else {
                    dropdownMenu.classList.remove('hidden');
                    requestAnimationFrame(() => {
                        dropdownMenu.classList.remove('opacity-0', 'translate-y-1');
                        dropdownMenu.classList.add('opacity-100', 'translate-y-0');
                    });
                    chevron.classList.add('rotate-180');
                    dropdownBtn.setAttribute('aria-expanded', 'true');
                }
            });

            // Close on click outside
            document.addEventListener('click', function (e) {
                if (!document.getElementById('user-dropdown-container').contains(e.target)) {
                    dropdownMenu.classList.add('opacity-0', 'translate-y-1');
                    dropdownMenu.classList.remove('opacity-100', 'translate-y-0');
                    chevron.classList.remove('rotate-180');
                    dropdownBtn.setAttribute('aria-expanded', 'false');
                    setTimeout(() => dropdownMenu.classList.add('hidden'), 200);
                }
            });
        }
    });
</script>