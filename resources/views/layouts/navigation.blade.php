<!-- Mobile Overlay -->
<div x-data="{ open: false }" class="lg:hidden">
    <div x-show="open" x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 z-40 bg-warm-900/60 dark:bg-warm-950/80" @click="open = false"></div>

    <!-- Mobile nav -->
    <div x-show="open" x-transition:enter="transition-transform ease-in-out duration-300" x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0" x-transition:leave="transition-transform ease-in-out duration-300" x-transition:leave-start="translate-x-0" x-transition:leave-end="-translate-x-full" class="fixed inset-y-0 left-0 z-50 w-64 bg-white dark:bg-warm-800 border-r border-warm-200 dark:border-warm-700">
        <div class="flex items-center justify-between h-16 px-6 border-b border-warm-200 dark:border-warm-700">
            <div class="flex items-center space-x-3">
                <div class="w-8 h-8 rounded-lg bg-blue-gradient flex items-center justify-center">
                    <span class="text-sm font-bold text-white font-serif">PKL</span>
                </div>
                <span class="font-semibold text-warm-900 dark:text-warm-50">Monitoring</span>
            </div>
            <button @click="open = false" class="p-2 rounded-lg text-warm-400 hover:text-warm-600 dark:hover:text-warm-200 hover:bg-warm-100 dark:hover:bg-warm-700">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>
        <nav class="px-3 py-4 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Dashboard
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('laporan.index')" :active="request()->routeIs('laporan.*')">
                <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                Laporan PKL
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('presensi.index')" :active="request()->routeIs('presensi.*')">
                <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                Presensi
            </x-responsive-nav-link>
            @if(Auth::user()->role === 'admin')
                <div class="pt-4 pb-2">
                    <p class="px-3 text-xs font-semibold uppercase tracking-wider text-warm-400 dark:text-warm-500">Admin</p>
                </div>
                <x-responsive-nav-link :href="route('admin.siswa.index')" :active="request()->routeIs('admin.siswa.*')">
                    <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    Siswa
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.tempat-pkl.index')" :active="request()->routeIs('admin.tempat-pkl.*')">
                    <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    Tempat PKL
                </x-responsive-nav-link>
            @endif
        </nav>
        <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-warm-200 dark:border-warm-700">
            <div class="flex items-center space-x-3 px-3 py-2">
                <div class="w-8 h-8 rounded-full bg-blue-gradient flex items-center justify-center flex-shrink-0">
                    <span class="text-xs font-bold text-white">{{ substr(Auth::user()->name, 0, 1) }}</span>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-warm-900 dark:text-warm-50 truncate">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-warm-500 dark:text-warm-400 truncate">{{ Auth::user()->email }}</p>
                </div>
            </div>
            <div class="mt-2 space-y-1">
                <a href="{{ route('profile.edit') }}" class="flex items-center px-3 py-2 text-sm text-warm-600 dark:text-warm-300 hover:text-warm-900 dark:hover:text-warm-50 hover:bg-warm-100 dark:hover:bg-warm-700 rounded-lg transition-colors">
                    <svg class="w-4 h-4 mr-2.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    Profile
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center px-3 py-2 text-sm text-warm-600 dark:text-warm-300 hover:text-red-600 dark:hover:text-red-400 hover:bg-warm-100 dark:hover:bg-warm-700 rounded-lg transition-colors">
                        <svg class="w-4 h-4 mr-2.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                        Log Out
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Desktop Sidebar -->
<div class="hidden lg:fixed lg:inset-y-0 lg:z-30 lg:flex lg:w-64 lg:flex-col">
    <div class="flex flex-col flex-grow bg-white dark:bg-warm-800 border-r border-warm-200 dark:border-warm-700 overflow-y-auto">
        <div class="flex items-center h-16 px-6 border-b border-warm-200 dark:border-warm-700">
            <div class="w-8 h-8 rounded-lg bg-blue-gradient flex items-center justify-center shadow-blue-sm">
                <span class="text-sm font-bold text-white font-serif">PKL</span>
            </div>
            <span class="ml-3 font-semibold text-warm-900 dark:text-warm-50">Monitoring</span>
        </div>
        <nav class="flex-1 px-3 py-4 space-y-1">
            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Dashboard
            </x-nav-link>
            <x-nav-link :href="route('laporan.index')" :active="request()->routeIs('laporan.*')">
                <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                Laporan PKL
            </x-nav-link>
            <x-nav-link :href="route('presensi.index')" :active="request()->routeIs('presensi.*')">
                <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"/></svg>
                Presensi
            </x-nav-link>
            @if(Auth::user()->role === 'admin')
                <div class="pt-6 pb-2">
                    <p class="px-3 text-xs font-semibold uppercase tracking-wider text-warm-400 dark:text-warm-500">Manajemen</p>
                </div>
                <x-nav-link :href="route('admin.siswa.index')" :active="request()->routeIs('admin.siswa.*')">
                    <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    Siswa
                </x-nav-link>
                <x-nav-link :href="route('admin.tempat-pkl.index')" :active="request()->routeIs('admin.tempat-pkl.*')">
                    <svg class="w-5 h-5 mr-3 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    Tempat PKL
                </x-nav-link>
            @endif
        </nav>
        <div class="p-4 border-t border-warm-200 dark:border-warm-700">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3 min-w-0">
                    <div class="w-8 h-8 rounded-full bg-blue-gradient flex items-center justify-center flex-shrink-0">
                        <span class="text-xs font-bold text-white">{{ substr(Auth::user()->name, 0, 1) }}</span>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-medium text-warm-900 dark:text-warm-50 truncate">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-warm-500 dark:text-warm-400 truncate">{{ Auth::user()->email }}</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="p-1.5 rounded-lg text-warm-400 hover:text-red-500 hover:bg-warm-100 dark:hover:bg-warm-700 transition-colors" title="Logout">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Top Bar (Desktop) -->
<div class="sticky top-0 z-20 bg-white/90 dark:bg-warm-800/90 backdrop-blur-md border-b border-warm-200 dark:border-warm-700">
    <div class="flex items-center justify-between h-16 px-4 sm:px-6 lg:px-8">
        <div class="flex items-center">
            <!-- Mobile menu button -->
            <button @click="$el.closest('[x-data]').__x.$data.open = true" class="lg:hidden p-2 -ml-2 rounded-lg text-warm-400 hover:text-warm-600 dark:hover:text-warm-200 hover:bg-warm-100 dark:hover:bg-warm-700 transition-colors">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
            </button>
            @isset($header)
                <div class="ml-2 lg:ml-0">
                    {{ $header }}
                </div>
            @endisset
        </div>
        <div class="flex items-center space-x-3">
            <button onclick="toggleDarkMode()" class="p-2 rounded-lg text-warm-400 hover:text-blue-600 dark:hover:text-blue-300 hover:bg-blue-500/10 dark:hover:bg-blue-500/10 transition-all duration-200" title="Toggle theme">
                <svg class="w-5 h-5 block dark:hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                </svg>
                <svg class="w-5 h-5 hidden dark:block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
            </button>
            <a href="{{ route('profile.edit') }}" class="flex items-center space-x-2.5 p-1.5 rounded-lg hover:bg-warm-100 dark:hover:bg-warm-700 transition-colors">
                <div class="w-7 h-7 rounded-full bg-blue-gradient flex items-center justify-center flex-shrink-0">
                    <span class="text-xs font-bold text-white">{{ substr(Auth::user()->name, 0, 1) }}</span>
                </div>
                <div class="hidden sm:block text-sm font-medium text-warm-700 dark:text-warm-200">{{ Auth::user()->name }}</div>
            </a>
        </div>
    </div>
</div>
