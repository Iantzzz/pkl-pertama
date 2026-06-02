<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-serif text-2xl font-bold text-warm-900 dark:text-warm-50">
                Laporan {{ $user->name }}
            </h2>
            <p class="text-sm text-warm-500 dark:text-gold-300/70 mt-0.5">Detail laporan siswa</p>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <a href="{{ route('admin.siswa.index') }}" class="inline-flex items-center text-sm text-gold-600 dark:text-gold-300 hover:text-gold-500 transition-colors">
                <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                Kembali ke daftar siswa
            </a>

            <div class="rounded-2xl bg-white dark:bg-warm-900 shadow-warm dark:shadow-warm-lg border border-warm-200 dark:border-gold-500/10 p-6">
                <h3 class="font-serif text-lg font-semibold text-warm-900 dark:text-warm-50 mb-4">Data Siswa</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                    <div>
                        <label class="block text-xs font-semibold text-gold-600 dark:text-gold-300 uppercase tracking-wider mb-1">Nama</label>
                        <p class="text-warm-700 dark:text-warm-300">{{ $user->name }}</p>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gold-600 dark:text-gold-300 uppercase tracking-wider mb-1">Email</label>
                        <p class="text-warm-700 dark:text-warm-300">{{ $user->email }}</p>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gold-600 dark:text-gold-300 uppercase tracking-wider mb-1">Total Laporan</label>
                        <p class="text-warm-700 dark:text-warm-300">{{ $laporans->total() }}</p>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gold-600 dark:text-gold-300 uppercase tracking-wider mb-1">Tempat PKL</label>
                        <p class="text-warm-700 dark:text-warm-300">{{ $user->tempatPkl ? $user->tempatPkl->nama_perusahaan : '-' }}</p>
                    </div>
                </div>

                <div class="mt-6 p-4 bg-gold-500/5 dark:bg-gold-500/5 rounded-xl border border-gold-500/10 dark:border-gold-500/20">
                    <h4 class="font-semibold text-warm-900 dark:text-warm-50 mb-3 text-sm">Atur Tempat PKL</h4>
                    <form action="{{ route('admin.siswa.tempat-pkl', $user) }}" method="POST" class="flex gap-2 items-end">
                        @csrf
                        @method('PATCH')
                        <div class="flex-1">
                            <select name="tempat_pkl_id" class="w-full rounded-xl border border-warm-200 dark:border-warm-700 bg-white dark:bg-warm-800 text-sm text-warm-900 dark:text-warm-50 focus:border-gold-500 focus:ring-2 focus:ring-gold-500/30 transition-all">
                                <option value="" class="bg-white dark:bg-warm-800">-- Pilih Tempat PKL --</option>
                                @foreach($tempatPkls as $tp)
                                    <option value="{{ $tp->id }}" {{ $user->tempat_pkl_id == $tp->id ? 'selected' : '' }} class="bg-white dark:bg-warm-800">{{ $tp->nama_perusahaan }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="px-4 py-2 bg-gold-gradient text-warm-900 font-semibold text-xs rounded-xl shadow-gold-sm hover:shadow-gold transition-all duration-200">Simpan</button>
                    </form>
                </div>
            </div>

            @if($laporans->count() > 0)
                <div class="rounded-2xl bg-white dark:bg-warm-900 shadow-warm dark:shadow-warm-lg border border-warm-200 dark:border-gold-500/10 p-6">
                    <h4 class="font-serif text-lg font-semibold text-warm-900 dark:text-warm-50 mb-4">Laporan Siswa</h4>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead>
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-gold-600 dark:text-gold-300 uppercase tracking-wider bg-gold-500/10 dark:bg-gold-500/5">Tanggal</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-gold-600 dark:text-gold-300 uppercase tracking-wider bg-gold-500/10 dark:bg-gold-500/5">Kegiatan</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-gold-600 dark:text-gold-300 uppercase tracking-wider bg-gold-500/10 dark:bg-gold-500/5">Status</th>
                                    <th class="px-4 py-3 text-left text-xs font-semibold text-gold-600 dark:text-gold-300 uppercase tracking-wider bg-gold-500/10 dark:bg-gold-500/5">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-warm-100 dark:divide-gold-500/5">
                                @foreach($laporans as $l)
                                <tr class="hover:bg-gold-500/5 dark:hover:bg-gold-500/5 transition-colors">
                                    <td class="px-4 py-3 text-warm-700 dark:text-warm-300">{{ $l->tanggal }}</td>
                                    <td class="px-4 py-3 text-warm-700 dark:text-warm-300">{{ $l->kegiatan }}</td>
                                    <td class="px-4 py-3">
                                        @php
                                            $statusColors = ['pending' => 'bg-amber-100 text-amber-800 dark:bg-amber-500/20 dark:text-amber-400', 'disetujui' => 'bg-emerald-100 text-emerald-800 dark:bg-emerald-500/20 dark:text-emerald-400', 'ditolak' => 'bg-red-100 text-red-800 dark:bg-red-500/20 dark:text-red-400'];
                                        @endphp
                                        <span class="px-3 py-1 rounded-full text-xs font-semibold tracking-wide {{ $statusColors[$l->status] ?? 'bg-warm-100 dark:bg-warm-700 text-warm-500 dark:text-warm-300' }}">{{ ucfirst($l->status) }}</span>
                                    </td>
                                    <td class="px-4 py-3">
                                        <a href="{{ route('laporan.show', $l) }}" class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-gold-600 dark:text-gold-300 bg-gold-500/10 hover:bg-gold-500/20 rounded-lg transition-all duration-200">Detail</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $laporans->links() }}
                    </div>
                </div>
            @else
                <div class="rounded-2xl bg-white dark:bg-warm-900 shadow-warm dark:shadow-warm-lg border border-warm-200 dark:border-gold-500/10 p-12 text-center">
                    <div class="w-16 h-16 rounded-full bg-gold-500/10 dark:bg-gold-500/10 flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-gold-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    <p class="text-warm-500 dark:text-gold-300/70">Siswa ini belum memiliki laporan.</p>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
