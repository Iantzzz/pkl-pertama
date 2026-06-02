<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-serif text-2xl font-bold text-warm-900 dark:text-warm-50">
                {{ __('Laporan PKL') }}
            </h2>
            <p class="text-sm text-warm-500 dark:text-gold-300/70 mt-0.5">Kelola laporan Praktik Kerja Lapangan</p>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if(session('success'))
                <div class="p-4 bg-emerald-50 dark:bg-emerald-500/10 border border-emerald-200 dark:border-emerald-500/20 text-emerald-700 dark:text-emerald-400 rounded-xl text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="rounded-2xl bg-white dark:bg-warm-900 shadow-warm dark:shadow-warm-lg border border-warm-200 dark:border-gold-500/10 overflow-hidden">
                <div class="p-6">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
                        <h3 class="font-serif text-lg font-semibold text-warm-900 dark:text-warm-50">Daftar Laporan</h3>
                        <div class="flex gap-2">
                            <a href="{{ route('laporan.export.pdf', request()->query()) }}" class="inline-flex items-center px-4 py-2 border border-gold-500/30 dark:border-gold-500/40 text-gold-600 dark:text-gold-300 font-semibold text-xs rounded-xl hover:bg-gold-500/10 transition-all duration-200">
                                <svg class="w-3.5 h-3.5 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                PDF
                            </a>
                            <a href="{{ route('laporan.export.excel', request()->query()) }}" class="inline-flex items-center px-4 py-2 border border-emerald-500/30 dark:border-emerald-500/40 text-emerald-600 dark:text-emerald-400 font-semibold text-xs rounded-xl hover:bg-emerald-500/10 transition-all duration-200">
                                <svg class="w-3.5 h-3.5 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                Excel
                            </a>
                            <a href="{{ route('laporan.create') }}" class="inline-flex items-center px-4 py-2 bg-gold-gradient text-warm-900 font-semibold text-xs rounded-xl shadow-gold-sm hover:shadow-gold transition-all duration-200">
                                <svg class="w-3.5 h-3.5 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                Tambah Laporan
                            </a>
                        </div>
                    </div>

                    <form method="GET" action="{{ route('laporan.index') }}" class="mb-6 p-4 bg-gold-500/5 dark:bg-gold-500/5 rounded-xl border border-gold-500/10 dark:border-gold-500/20 flex flex-wrap gap-3 items-end">
                        <div>
                            <label class="block text-xs font-medium text-warm-600 dark:text-gold-300/70 mb-1 tracking-wide">Cari</label>
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari kegiatan/deskripsi..." class="w-full rounded-xl border border-warm-200 dark:border-warm-700 bg-white dark:bg-warm-800 px-3 py-2 text-sm text-warm-900 dark:text-warm-50 placeholder-warm-400 dark:placeholder-gold-300/30 focus:border-gold-500 focus:ring-2 focus:ring-gold-500/30 transition-all duration-200">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-warm-600 dark:text-gold-300/70 mb-1 tracking-wide">Tanggal Dari</label>
                            <input type="date" name="tanggal_from" value="{{ request('tanggal_from') }}" class="w-full rounded-xl border border-warm-200 dark:border-warm-700 bg-white dark:bg-warm-800 px-3 py-2 text-sm text-warm-900 dark:text-warm-50 focus:border-gold-500 focus:ring-2 focus:ring-gold-500/30 transition-all duration-200">
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-warm-600 dark:text-gold-300/70 mb-1 tracking-wide">Tanggal Sampai</label>
                            <input type="date" name="tanggal_to" value="{{ request('tanggal_to') }}" class="w-full rounded-xl border border-warm-200 dark:border-warm-700 bg-white dark:bg-warm-800 px-3 py-2 text-sm text-warm-900 dark:text-warm-50 focus:border-gold-500 focus:ring-2 focus:ring-gold-500/30 transition-all duration-200">
                        </div>
                        <button type="submit" class="px-4 py-2 bg-gold-gradient text-warm-900 font-semibold text-sm rounded-xl shadow-gold-sm hover:shadow-gold transition-all duration-200">Filter</button>
                        @if(request()->anyFilled(['search', 'tanggal_from', 'tanggal_to']))
                            <a href="{{ route('laporan.index') }}" class="px-4 py-2 border border-warm-200 dark:border-warm-700 text-warm-500 dark:text-gold-300/70 text-sm rounded-xl hover:bg-warm-100 dark:hover:bg-warm-800 transition-all duration-200">Reset</a>
                        @endif
                    </form>

                    @if($laporans->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm">
                                <thead>
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-gold-600 dark:text-gold-300 uppercase tracking-wider bg-gold-500/10 dark:bg-gold-500/5">Tanggal</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-gold-600 dark:text-gold-300 uppercase tracking-wider bg-gold-500/10 dark:bg-gold-500/5">Kegiatan</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-gold-600 dark:text-gold-300 uppercase tracking-wider bg-gold-500/10 dark:bg-gold-500/5">Deskripsi</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-gold-600 dark:text-gold-300 uppercase tracking-wider bg-gold-500/10 dark:bg-gold-500/5">Status</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-gold-600 dark:text-gold-300 uppercase tracking-wider bg-gold-500/10 dark:bg-gold-500/5">Foto</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-gold-600 dark:text-gold-300 uppercase tracking-wider bg-gold-500/10 dark:bg-gold-500/5">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-warm-100 dark:divide-gold-500/5">
                                    @foreach($laporans as $l)
                                    <tr class="hover:bg-gold-500/5 dark:hover:bg-gold-500/5 transition-colors">
                                        <td class="px-4 py-3 text-warm-700 dark:text-warm-300">{{ $l->tanggal }}</td>
                                        <td class="px-4 py-3 text-warm-700 dark:text-warm-300 font-medium">{{ $l->kegiatan }}</td>
                                        <td class="px-4 py-3 text-warm-500 dark:text-gold-300/70 max-w-xs truncate">{{ Str::limit($l->deskripsi, 60) }}</td>
                                        <td class="px-4 py-3">
                                            @php
                                                $statusColors = ['pending' => 'bg-amber-100 text-amber-800 dark:bg-amber-500/20 dark:text-amber-400', 'disetujui' => 'bg-emerald-100 text-emerald-800 dark:bg-emerald-500/20 dark:text-emerald-400', 'ditolak' => 'bg-red-100 text-red-800 dark:bg-red-500/20 dark:text-red-400'];
                                            @endphp
                                            <span class="px-3 py-1 rounded-full text-xs font-semibold tracking-wide {{ $statusColors[$l->status] ?? 'bg-warm-100 dark:bg-warm-700 text-warm-500 dark:text-warm-300' }}">
                                                {{ ucfirst($l->status) }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3">
                                            @if($l->foto)
                                                <img src="{{ asset('storage/' . $l->foto) }}" class="w-12 h-12 object-cover rounded-xl border border-gold-500/20 shadow-warm">
                                            @else
                                                <span class="text-warm-400 dark:text-gold-300/30">-</span>
                                            @endif
                                        </td>
                                        <td class="px-4 py-3">
                                            <div class="flex gap-2">
                                                <a href="{{ route('laporan.show', $l) }}" class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-gold-600 dark:text-gold-300 bg-gold-500/10 hover:bg-gold-500/20 rounded-lg transition-all duration-200">Detail</a>
                                                <a href="{{ route('laporan.edit', $l) }}" class="inline-flex items-center px-3 py-1.5 text-xs font-medium text-amber-600 dark:text-amber-400 bg-amber-500/10 hover:bg-amber-500/20 rounded-lg transition-all duration-200">Edit</a>
                                                <form action="{{ route('laporan.destroy', $l) }}" method="POST" onsubmit="return confirm('Hapus laporan ini?')">
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
                            {{ $laporans->links() }}
                        </div>
                    @else
                        <div class="text-center py-12">
                            <div class="w-16 h-16 rounded-full bg-gold-500/10 dark:bg-gold-500/10 flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-gold-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            </div>
                            <p class="text-warm-500 dark:text-gold-300/70">Belum ada laporan.</p>
                            <a href="{{ route('laporan.create') }}" class="inline-flex items-center mt-4 px-5 py-2.5 bg-gold-gradient text-warm-900 font-semibold text-sm rounded-xl shadow-gold-sm hover:shadow-gold transition-all duration-200">Buat Laporan Pertama</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
