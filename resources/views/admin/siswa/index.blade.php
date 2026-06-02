<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-serif text-2xl font-bold text-warm-900 dark:text-warm-50">
                {{ __('Manajemen Siswa') }}
            </h2>
            <p class="text-sm text-warm-500 dark:text-gold-300/70 mt-0.5">Kelola data siswa Praktik Kerja Lapangan</p>
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
                    <h3 class="font-serif text-lg font-semibold text-warm-900 dark:text-warm-50 mb-6">Daftar Siswa PKL</h3>

                    @if($siswas->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm">
                                <thead>
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-gold-600 dark:text-gold-300 uppercase tracking-wider bg-gold-500/10 dark:bg-gold-500/5">Nama</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-gold-600 dark:text-gold-300 uppercase tracking-wider bg-gold-500/10 dark:bg-gold-500/5">Email</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-gold-600 dark:text-gold-300 uppercase tracking-wider bg-gold-500/10 dark:bg-gold-500/5">Jumlah Laporan</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-gold-600 dark:text-gold-300 uppercase tracking-wider bg-gold-500/10 dark:bg-gold-500/5">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-warm-100 dark:divide-gold-500/5">
                                    @foreach($siswas as $siswa)
                                    <tr class="hover:bg-gold-500/5 dark:hover:bg-gold-500/5 transition-colors">
                                        <td class="px-4 py-3">
                                            <div class="flex items-center gap-2">
                                                <div class="w-8 h-8 rounded-full bg-gold-gradient flex items-center justify-center flex-shrink-0">
                                                    <span class="text-xs font-bold text-warm-900">{{ substr($siswa->name, 0, 1) }}</span>
                                                </div>
                                                <span class="font-medium text-warm-700 dark:text-warm-200">{{ $siswa->name }}</span>
                                            </div>
                                        </td>
                                        <td class="px-4 py-3 text-warm-500 dark:text-gold-300/70">{{ $siswa->email }}</td>
                                        <td class="px-4 py-3">
                                            <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-gold-500/10 dark:bg-gold-500/10 text-gold-600 dark:text-gold-300">{{ $siswa->laporans_count }}</span>
                                        </td>
                                        <td class="px-4 py-3">
                                            <a href="{{ route('admin.siswa.show', $siswa) }}" class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-gold-600 dark:text-gold-300 bg-gold-500/10 hover:bg-gold-500/20 rounded-lg transition-all duration-200">Lihat Laporan</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4">
                            {{ $siswas->links() }}
                        </div>
                    @else
                        <div class="text-center py-12">
                            <div class="w-16 h-16 rounded-full bg-gold-500/10 dark:bg-gold-500/10 flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-gold-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </div>
                            <p class="text-warm-500 dark:text-gold-300/70">Belum ada siswa terdaftar.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
