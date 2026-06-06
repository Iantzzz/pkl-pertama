<x-app-layout>
    <x-slot name="header">
        <h1 class="text-lg font-semibold text-warm-900 dark:text-warm-50">Manajemen Siswa</h1>
    </x-slot>

    <div class="py-8 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">

        @if(session('success'))
            <div class="mb-6 p-4 bg-emerald-50 dark:bg-emerald-500/10 border border-emerald-200 dark:border-emerald-500/20 text-emerald-700 dark:text-emerald-400 rounded-xl text-sm">{{ session('success') }}</div>
        @endif

        <div class="bg-white dark:bg-warm-800 rounded-xl border border-warm-200 dark:border-warm-700 shadow-sm overflow-hidden">
            <div class="p-5 sm:p-6">
                <h3 class="text-base font-semibold text-warm-900 dark:text-warm-50 mb-5">Daftar Siswa PKL</h3>

                @if($siswas->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="border-b border-warm-200 dark:border-warm-700">
                                    <th class="px-4 py-3.5 text-left text-xs font-semibold text-warm-500 dark:text-warm-400 uppercase tracking-wider">Nama</th>
                                    <th class="px-4 py-3.5 text-left text-xs font-semibold text-warm-500 dark:text-warm-400 uppercase tracking-wider">Email</th>
                                    <th class="px-4 py-3.5 text-left text-xs font-semibold text-warm-500 dark:text-warm-400 uppercase tracking-wider">Laporan</th>
                                    <th class="px-4 py-3.5 text-left text-xs font-semibold text-warm-500 dark:text-warm-400 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-warm-100 dark:divide-warm-700/50">
                                @foreach($siswas as $siswa)
                                <tr class="hover:bg-warm-50 dark:hover:bg-warm-700/30 transition-colors">
                                    <td class="px-4 py-3.5">
                                        <div class="flex items-center gap-2.5">
                                            <div class="w-8 h-8 rounded-full bg-blue-gradient flex items-center justify-center flex-shrink-0">
                                                <span class="text-xs font-bold text-white">{{ substr($siswa->name, 0, 1) }}</span>
                                            </div>
                                            <span class="font-medium text-warm-900 dark:text-warm-50">{{ $siswa->name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3.5 text-warm-500 dark:text-warm-400">{{ $siswa->email }}</td>
                                    <td class="px-4 py-3.5">
                                        <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-blue-50 dark:bg-blue-500/10 text-blue-600 dark:text-blue-400">{{ $siswa->laporans_count }}</span>
                                    </td>
                                    <td class="px-4 py-3.5">
                                        <a href="{{ route('admin.siswa.show', $siswa) }}" class="px-2.5 py-1.5 text-xs font-medium text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-500/10 rounded-lg hover:bg-blue-100 dark:hover:bg-blue-500/20 transition-colors">Lihat Laporan</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-5">{{ $siswas->links() }}</div>
                @else
                    <div class="text-center py-12">
                        <div class="w-14 h-14 rounded-full bg-warm-100 dark:bg-warm-700 flex items-center justify-center mx-auto mb-4">
                            <svg class="w-7 h-7 text-warm-400 dark:text-warm-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </div>
                        <p class="text-warm-500 dark:text-warm-400">Belum ada siswa terdaftar.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
