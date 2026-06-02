<nav x-data="{ open: false }" class="sticky top-0 z-50 bg-white dark:bg-warm-900 border-b border-warm-200 dark:border-gold-500/10 shadow-warm-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-3">
                        <div class="w-9 h-9 rounded-lg bg-gold-gradient flex items-center justify-center shadow-gold-sm">
                            <span class="text-base font-bold text-warm-900 font-serif">PKL</span>
                        </div>
                        <span class="hidden sm:block font-serif font-semibold text-lg text-warm-900 dark:text-warm-50">Monitoring</span>
                    </a>
                </div>

                <div class="hidden sm:flex sm:items-center sm:ms-10 sm:space-x-1">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        Dashboard
                    </x-nav-link>
                    <x-nav-link :href="route('laporan.index')" :active="request()->routeIs('laporan.*')">
                        Laporan PKL
                    </x-nav-link>
                    <x-nav-link :href="route('presensi.index')" :active="request()->routeIs('presensi.*')">
                        Presensi
                    </x-nav-link>
                    @if(Auth::user()->role === 'admin')
                        <x-nav-link :href="route('admin.siswa.index')" :active="request()->routeIs('admin.siswa.*')">
                            Siswa
                        </x-nav-link>
                        <x-nav-link :href="route('admin.tempat-pkl.index')" :active="request()->routeIs('admin.tempat-pkl.*')">
                            Tempat PKL
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:space-x-3">
                <button onclick="toggleDarkMode()" class="p-2 rounded-lg text-warm-400 dark:text-gold-300/70 hover:text-gold-600 dark:hover:text-gold-300 hover:bg-gold-500/10 dark:hover:bg-gold-500/10 transition-all duration-200" title="Toggle theme">
                    <svg class="w-5 h-5 block dark:hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                    </svg>
                    <svg class="w-5 h-5 hidden dark:block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </button>

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-warm-200 dark:border-gold-500/20 text-sm leading-4 font-medium rounded-xl text-warm-700 dark:text-gold-300 bg-warm-50 dark:bg-warm-800 hover:bg-gold-500/10 dark:hover:bg-gold-500/10 hover:border-gold-500/30 focus:outline-none transition-all duration-200">
                            <div class="w-6 h-6 rounded-full bg-gold-gradient flex items-center justify-center mr-2">
                                <span class="text-xs font-bold text-warm-900">{{ substr(Auth::user()->name, 0, 1) }}</span>
                            </div>
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="px-4 py-3 border-b border-warm-200 dark:border-gold-500/10">
                            <p class="text-sm font-medium text-warm-900 dark:text-warm-50">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-warm-500 dark:text-gold-300/70 truncate">{{ Auth::user()->email }}</p>
                        </div>
                        <div class="py-1">
                            <x-dropdown-link :href="route('profile.edit')">
                                Profile
                            </x-dropdown-link>
                        </div>
                        <div class="border-t border-warm-200 dark:border-gold-500/10 py-1">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                    Log Out
                                </x-dropdown-link>
                            </form>
                        </div>
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="flex items-center sm:hidden space-x-1">
                <button onclick="toggleDarkMode()" class="p-2 rounded-lg text-warm-400 dark:text-gold-300/70 hover:text-gold-600 dark:hover:text-gold-300 hover:bg-gold-500/10 dark:hover:bg-gold-500/10 transition-all duration-200">
                    <svg class="w-5 h-5 block dark:hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                    </svg>
                    <svg class="w-5 h-5 hidden dark:block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </button>

                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-lg text-warm-400 dark:text-gold-300/70 hover:text-gold-600 dark:hover:text-gold-300 hover:bg-gold-500/10 dark:hover:bg-gold-500/10 transition-all duration-200">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white dark:bg-warm-900 border-t border-warm-200 dark:border-gold-500/10">
        <div class="pt-2 pb-3 space-y-1 px-4">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                Dashboard
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('laporan.index')" :active="request()->routeIs('laporan.*')">
                Laporan PKL
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('presensi.index')" :active="request()->routeIs('presensi.*')">
                Presensi
            </x-responsive-nav-link>
            @if(Auth::user()->role === 'admin')
                <x-responsive-nav-link :href="route('admin.siswa.index')" :active="request()->routeIs('admin.siswa.*')">
                    Siswa
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('admin.tempat-pkl.index')" :active="request()->routeIs('admin.tempat-pkl.*')">
                    Tempat PKL
                </x-responsive-nav-link>
            @endif
        </div>

        <div class="pt-4 pb-3 border-t border-warm-200 dark:border-gold-500/10">
            <div class="px-4">
                <div class="font-medium text-warm-900 dark:text-warm-50">{{ Auth::user()->name }}</div>
                <div class="text-sm text-warm-500 dark:text-gold-300/70">{{ Auth::user()->email }}</div>
            </div>
            <div class="mt-3 space-y-1 px-4">
                <x-responsive-nav-link :href="route('profile.edit')">
                    Profile
                </x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                        Log Out
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
