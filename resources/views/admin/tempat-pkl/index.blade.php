<x-app-layout>
    <x-slot name="header">
        <h1 class="text-lg font-semibold text-warm-900 dark:text-warm-50">Tempat PKL</h1>
    </x-slot>

    <div class="py-8 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">

        @if(session('success'))
            <div class="mb-6 p-4 bg-emerald-50 dark:bg-emerald-500/10 border border-emerald-200 dark:border-emerald-500/20 text-emerald-700 dark:text-emerald-400 rounded-xl text-sm">{{ session('success') }}</div>
        @endif

        <div class="bg-white dark:bg-warm-800 rounded-xl border border-warm-200 dark:border-warm-700 shadow-sm overflow-hidden">
            <div class="p-5 sm:p-6">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-5">
                    <h3 class="text-base font-semibold text-warm-900 dark:text-warm-50">Daftar Tempat PKL</h3>
                    <a href="{{ route('admin.tempat-pkl.create') }}" class="inline-flex items-center px-3.5 py-2 bg-blue-gradient text-white font-medium text-xs rounded-lg shadow-sm hover:shadow transition-all duration-200">
                        <svg class="w-3.5 h-3.5 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        Tambah Tempat PKL
                    </a>
                </div>

                @if($tempatPkls->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="border-b border-warm-200 dark:border-warm-700">
                                    <th class="px-4 py-3.5 text-left text-xs font-semibold text-warm-500 dark:text-warm-400 uppercase tracking-wider">Perusahaan</th>
                                    <th class="px-4 py-3.5 text-left text-xs font-semibold text-warm-500 dark:text-warm-400 uppercase tracking-wider">Alamat</th>
                                    <th class="px-4 py-3.5 text-left text-xs font-semibold text-warm-500 dark:text-warm-400 uppercase tracking-wider">Kontak</th>
                                    <th class="px-4 py-3.5 text-left text-xs font-semibold text-warm-500 dark:text-warm-400 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-warm-100 dark:divide-warm-700/50">
                                @foreach($tempatPkls as $tp)
                                <tr class="hover:bg-warm-50 dark:hover:bg-warm-700/30 transition-colors">
                                    <td class="px-4 py-3.5 font-medium text-warm-900 dark:text-warm-50">{{ $tp->nama_perusahaan }}</td>
                                    <td class="px-4 py-3.5 text-warm-500 dark:text-warm-400 max-w-xs truncate">{{ Str::limit($tp->alamat, 50) }}</td>
                                    <td class="px-4 py-3.5 text-warm-500 dark:text-warm-400">{{ $tp->kontak ?? '-' }}</td>
                                    <td class="px-4 py-3.5">
                                        <div class="flex gap-2">
                                            <a href="{{ route('admin.tempat-pkl.edit', $tp) }}" class="px-2.5 py-1.5 text-xs font-medium text-amber-600 dark:text-amber-400 bg-amber-50 dark:bg-amber-500/10 rounded-lg hover:bg-amber-100 dark:hover:bg-amber-500/20 transition-colors">Edit</a>
                                            <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'hapus-tempat-{{ $tp->id }}')" class="px-2.5 py-1.5 text-xs font-medium text-red-600 dark:text-red-400 bg-red-50 dark:bg-red-500/10 rounded-lg hover:bg-red-100 dark:hover:bg-red-500/20 transition-colors cursor-pointer">Hapus</button>
                                            <x-modal name="hapus-tempat-{{ $tp->id }}" :show="false" focusable>
                                                <div class="p-6">
                                                    <h2 class="text-base font-semibold text-warm-900 dark:text-warm-50">Hapus Tempat PKL</h2>
                                                    <p class="mt-2 text-sm text-warm-500 dark:text-warm-400">Apakah Anda yakin ingin menghapus tempat PKL "<strong>{{ $tp->nama_perusahaan }}</strong>"? Tindakan ini tidak dapat dibatalkan.</p>
                                                    <div class="mt-6 flex justify-end gap-3">
                                                        <button x-on:click="$dispatch('close')" type="button" class="px-4 py-2 border border-warm-200 dark:border-warm-700 text-warm-600 dark:text-warm-300 text-sm rounded-lg hover:bg-warm-50 dark:hover:bg-warm-700 transition-colors">Batal</button>
                                                        <form action="{{ route('admin.tempat-pkl.destroy', $tp) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="px-4 py-2 bg-red-600 text-white text-sm rounded-lg hover:bg-red-500 transition-colors">Ya, Hapus</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </x-modal>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-5">{{ $tempatPkls->links() }}</div>
                @else
                    <div class="text-center py-12">
                        <div class="w-14 h-14 rounded-full bg-warm-100 dark:bg-warm-700 flex items-center justify-center mx-auto mb-4">
                            <svg class="w-7 h-7 text-warm-400 dark:text-warm-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        </div>
                        <p class="text-warm-500 dark:text-warm-400">Belum ada tempat PKL.</p>
                        <a href="{{ route('admin.tempat-pkl.create') }}" class="inline-flex items-center mt-4 px-4 py-2 bg-blue-gradient text-white font-medium text-sm rounded-lg shadow-sm hover:shadow transition-all">Tambah Sekarang</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
