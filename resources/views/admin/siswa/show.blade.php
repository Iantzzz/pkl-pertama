<x-app-layout>
    <x-slot name="header">
        <h1 class="text-lg font-semibold text-warm-900 dark:text-warm-50">Laporan {{ $user->name }}</h1>
    </x-slot>

    <div class="py-8 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto space-y-6">
        <a href="{{ route('admin.siswa.index') }}" class="inline-flex items-center text-sm text-warm-500 dark:text-warm-400 hover:text-warm-700 dark:hover:text-warm-200 transition-colors">
            <svg class="w-4 h-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Kembali
        </a>

        <div class="bg-white dark:bg-warm-800 rounded-xl border border-warm-200 dark:border-warm-700 shadow-sm p-6">
            <h3 class="text-base font-semibold text-warm-900 dark:text-warm-50 mb-4">Data Siswa</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                <div>
                    <label class="block text-xs font-semibold text-warm-500 dark:text-warm-400 uppercase tracking-wider mb-1">Nama</label>
                    <p class="text-warm-900 dark:text-warm-50">{{ $user->name }}</p>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-warm-500 dark:text-warm-400 uppercase tracking-wider mb-1">Email</label>
                    <p class="text-warm-700 dark:text-warm-300">{{ $user->email }}</p>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-warm-500 dark:text-warm-400 uppercase tracking-wider mb-1">Total Laporan</label>
                    <p class="text-warm-900 dark:text-warm-50">{{ $laporans->total() }}</p>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-warm-500 dark:text-warm-400 uppercase tracking-wider mb-1">Tempat PKL</label>
                    <p class="text-warm-700 dark:text-warm-300">{{ $user->tempatPkl ? $user->tempatPkl->nama_perusahaan : '-' }}</p>
                </div>
            </div>

            <div class="mt-6 p-4 bg-warm-50 dark:bg-warm-700/30 rounded-xl border border-warm-200 dark:border-warm-700">
                <h4 class="font-semibold text-warm-900 dark:text-warm-50 mb-3 text-sm">Atur Tempat PKL</h4>
                <form action="{{ route('admin.siswa.tempat-pkl', $user) }}" method="POST" class="flex gap-2 items-end">
                    @csrf @method('PATCH')
                    <div class="flex-1">
                        <select name="tempat_pkl_id" class="w-full rounded-lg border border-warm-200 dark:border-warm-700 bg-white dark:bg-warm-800 text-sm text-warm-900 dark:text-warm-50 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20">
                            <option value="">-- Pilih Tempat PKL --</option>
                            @foreach($tempatPkls as $tp)
                                <option value="{{ $tp->id }}" {{ $user->tempat_pkl_id == $tp->id ? 'selected' : '' }}>{{ $tp->nama_perusahaan }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="px-3 py-2 bg-blue-gradient text-white font-semibold text-xs rounded-lg shadow-sm hover:shadow transition-all">Simpan</button>
                </form>
            </div>
        </div>

        @if($laporans->count() > 0)
            <div class="bg-white dark:bg-warm-800 rounded-xl border border-warm-200 dark:border-warm-700 shadow-sm p-6">
                <h4 class="text-base font-semibold text-warm-900 dark:text-warm-50 mb-4">Laporan Siswa</h4>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="border-b border-warm-200 dark:border-warm-700">
                                <th class="px-4 py-3.5 text-left text-xs font-semibold text-warm-500 dark:text-warm-400 uppercase tracking-wider">Tanggal</th>
                                <th class="px-4 py-3.5 text-left text-xs font-semibold text-warm-500 dark:text-warm-400 uppercase tracking-wider">Kegiatan</th>
                                <th class="px-4 py-3.5 text-left text-xs font-semibold text-warm-500 dark:text-warm-400 uppercase tracking-wider">Status</th>
                                <th class="px-4 py-3.5 text-left text-xs font-semibold text-warm-500 dark:text-warm-400 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-warm-100 dark:divide-warm-700/50">
                            @foreach($laporans as $l)
                            <tr class="hover:bg-warm-50 dark:hover:bg-warm-700/30 transition-colors">
                                <td class="px-4 py-3.5 text-warm-600 dark:text-warm-300">{{ $l->tanggal }}</td>
                                <td class="px-4 py-3.5 text-warm-900 dark:text-warm-50">{{ $l->kegiatan }}</td>
                                <td class="px-4 py-3.5">
                                    @php
                                        $statusColors = ['pending' => 'bg-amber-50 text-amber-700 dark:bg-amber-500/10 dark:text-amber-400 border border-amber-200 dark:border-amber-500/20', 'disetujui' => 'bg-emerald-50 text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-500/20', 'ditolak' => 'bg-red-50 text-red-700 dark:bg-red-500/10 dark:text-red-400 border border-red-200 dark:border-red-500/20'];
                                    @endphp
                                    <span class="px-2.5 py-1 rounded-full text-xs font-semibold tracking-wide {{ $statusColors[$l->status] ?? 'bg-warm-100 text-warm-600 dark:bg-warm-700 dark:text-warm-300' }}">{{ ucfirst($l->status) }}</span>
                                </td>
                                <td class="px-4 py-3.5">
                                    <a href="{{ route('laporan.show', $l) }}" class="px-2.5 py-1.5 text-xs font-medium text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-500/10 rounded-lg hover:bg-blue-100 dark:hover:bg-blue-500/20 transition-colors">Detail</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-5">{{ $laporans->links() }}</div>
            </div>
        @else
            <div class="bg-white dark:bg-warm-800 rounded-xl border border-warm-200 dark:border-warm-700 shadow-sm p-12 text-center">
                <div class="w-14 h-14 rounded-full bg-warm-100 dark:bg-warm-700 flex items-center justify-center mx-auto mb-4">
                    <svg class="w-7 h-7 text-warm-400 dark:text-warm-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                </div>
                <p class="text-warm-500 dark:text-warm-400">Siswa ini belum memiliki laporan.</p>
            </div>
        @endif
    </div>
</x-app-layout>
