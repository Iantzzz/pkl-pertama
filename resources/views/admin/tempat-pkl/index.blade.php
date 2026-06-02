<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-serif text-2xl font-bold text-warm-900 dark:text-warm-50">
                {{ __('Tempat PKL') }}
            </h2>
            <p class="text-sm text-warm-500 dark:text-gold-300/70 mt-0.5">Kelola daftar perusahaan tempat Praktik Kerja Lapangan</p>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-6 p-4 bg-emerald-50 dark:bg-emerald-500/10 border border-emerald-200 dark:border-emerald-500/20 text-emerald-700 dark:text-emerald-400 rounded-xl text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="rounded-2xl bg-white dark:bg-warm-900 shadow-warm dark:shadow-warm-lg border border-warm-200 dark:border-gold-500/10 overflow-hidden">
                <div class="p-6">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
                        <h3 class="font-serif text-lg font-semibold text-warm-900 dark:text-warm-50">Daftar Tempat PKL</h3>
                        <a href="{{ route('admin.tempat-pkl.create') }}" class="inline-flex items-center px-4 py-2 bg-gold-gradient text-warm-900 font-semibold text-xs rounded-xl shadow-gold-sm hover:shadow-gold transition-all duration-200">
                            <svg class="w-3.5 h-3.5 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                            Tambah Tempat PKL
                        </a>
                    </div>

                    @if($tempatPkls->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm">
                                <thead>
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-gold-600 dark:text-gold-300 uppercase tracking-wider bg-gold-500/10 dark:bg-gold-500/5">Perusahaan</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-gold-600 dark:text-gold-300 uppercase tracking-wider bg-gold-500/10 dark:bg-gold-500/5">Alamat</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-gold-600 dark:text-gold-300 uppercase tracking-wider bg-gold-500/10 dark:bg-gold-500/5">Kontak</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-gold-600 dark:text-gold-300 uppercase tracking-wider bg-gold-500/10 dark:bg-gold-500/5">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-warm-100 dark:divide-gold-500/5">
                                    @foreach($tempatPkls as $tp)
                                    <tr class="hover:bg-gold-500/5 dark:hover:bg-gold-500/5 transition-colors">
                                        <td class="px-4 py-3 font-medium text-warm-700 dark:text-warm-200">{{ $tp->nama_perusahaan }}</td>
                                        <td class="px-4 py-3 text-warm-500 dark:text-gold-300/70 max-w-xs truncate">{{ Str::limit($tp->alamat, 50) }}</td>
                                        <td class="px-4 py-3 text-warm-500 dark:text-gold-300/70">{{ $tp->kontak ?? '-' }}</td>
                                        <td class="px-4 py-3">
                                            <div class="flex gap-2">
                                                <a href="{{ route('admin.tempat-pkl.edit', $tp) }}" class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-amber-600 dark:text-amber-400 bg-amber-500/10 hover:bg-amber-500/20 rounded-lg transition-all duration-200">Edit</a>
                                                <form action="{{ route('admin.tempat-pkl.destroy', $tp) }}" method="POST" onsubmit="return confirm('Hapus tempat PKL ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-red-600 dark:text-red-400 bg-red-500/10 hover:bg-red-500/20 rounded-lg transition-all duration-200">Hapus</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4">
                            {{ $tempatPkls->links() }}
                        </div>
                    @else
                        <div class="text-center py-12">
                            <div class="w-16 h-16 rounded-full bg-gold-500/10 dark:bg-gold-500/10 flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-gold-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                            </div>
                            <p class="text-warm-500 dark:text-gold-300/70 mb-4">Belum ada tempat PKL.</p>
                            <a href="{{ route('admin.tempat-pkl.create') }}" class="inline-flex items-center px-5 py-2.5 bg-gold-gradient text-warm-900 font-semibold text-sm rounded-xl shadow-gold-sm hover:shadow-gold transition-all duration-200">Tambah Sekarang</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
