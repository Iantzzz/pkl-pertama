<x-app-layout>
    <x-slot name="header">
        <h1 class="text-lg font-semibold text-warm-900 dark:text-warm-50">Laporan PKL</h1>
    </x-slot>

    <div class="py-8 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto space-y-6">

        @if(session('success'))
            <div class="p-4 bg-emerald-50 dark:bg-emerald-500/10 border border-emerald-200 dark:border-emerald-500/20 text-emerald-700 dark:text-emerald-400 rounded-xl text-sm">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white dark:bg-warm-800 rounded-xl border border-warm-200 dark:border-warm-700 shadow-sm overflow-hidden">
            <div class="p-5 sm:p-6">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-5">
                    <h3 class="text-base font-semibold text-warm-900 dark:text-warm-50">Daftar Laporan</h3>
                    <div class="flex gap-2">
                        <a href="{{ route('laporan.export.pdf', request()->query()) }}" class="inline-flex items-center px-3.5 py-2 border border-warm-200 dark:border-warm-700 text-warm-600 dark:text-warm-300 font-medium text-xs rounded-lg hover:bg-warm-50 dark:hover:bg-warm-700 transition-colors">
                            <svg class="w-3.5 h-3.5 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            PDF
                        </a>
                        <a href="{{ route('laporan.export.excel', request()->query()) }}" class="inline-flex items-center px-3.5 py-2 border border-warm-200 dark:border-warm-700 text-warm-600 dark:text-warm-300 font-medium text-xs rounded-lg hover:bg-warm-50 dark:hover:bg-warm-700 transition-colors">
                            <svg class="w-3.5 h-3.5 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            Excel
                        </a>
                        <a href="{{ route('laporan.create') }}" class="inline-flex items-center px-3.5 py-2 bg-blue-gradient text-white font-medium text-xs rounded-lg shadow-sm hover:shadow transition-all duration-200">
                            <svg class="w-3.5 h-3.5 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                            Tambah
                        </a>
                    </div>
                </div>

                <form method="GET" action="{{ route('laporan.index') }}" class="mb-5 p-4 bg-warm-50 dark:bg-warm-700/30 rounded-xl border border-warm-200 dark:border-warm-700 flex flex-wrap gap-3 items-end">
                    <div>
                        <label class="block text-xs font-medium text-warm-500 dark:text-warm-400 mb-1">Cari</label>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Kegiatan / Deskripsi..." class="w-full rounded-lg border border-warm-200 dark:border-warm-700 bg-white dark:bg-warm-800 px-3 py-2 text-sm text-warm-900 dark:text-warm-50 placeholder-warm-400 dark:placeholder-warm-500 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-warm-500 dark:text-warm-400 mb-1">Dari</label>
                        <input type="date" name="tanggal_from" value="{{ request('tanggal_from') }}" class="rounded-lg border border-warm-200 dark:border-warm-700 bg-white dark:bg-warm-800 px-3 py-2 text-sm text-warm-900 dark:text-warm-50 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-warm-500 dark:text-warm-400 mb-1">Sampai</label>
                        <input type="date" name="tanggal_to" value="{{ request('tanggal_to') }}" class="rounded-lg border border-warm-200 dark:border-warm-700 bg-white dark:bg-warm-800 px-3 py-2 text-sm text-warm-900 dark:text-warm-50 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all">
                    </div>
                    <button type="submit" class="px-4 py-2 bg-blue-gradient text-white font-medium text-sm rounded-lg shadow-sm hover:shadow transition-all">Filter</button>
                    @if(request()->anyFilled(['search', 'tanggal_from', 'tanggal_to']))
                        <a href="{{ route('laporan.index') }}" class="px-4 py-2 border border-warm-200 dark:border-warm-700 text-warm-600 dark:text-warm-300 text-sm rounded-lg hover:bg-warm-50 dark:hover:bg-warm-700 transition-colors">Reset</a>
                    @endif
                </form>

                @if($laporans->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="border-b border-warm-200 dark:border-warm-700">
                                    <th class="px-4 py-3.5 text-left text-xs font-semibold text-warm-500 dark:text-warm-400 uppercase tracking-wider">Tanggal</th>
                                    <th class="px-4 py-3.5 text-left text-xs font-semibold text-warm-500 dark:text-warm-400 uppercase tracking-wider">Kegiatan</th>
                                    <th class="px-4 py-3.5 text-left text-xs font-semibold text-warm-500 dark:text-warm-400 uppercase tracking-wider">Deskripsi</th>
                                    <th class="px-4 py-3.5 text-left text-xs font-semibold text-warm-500 dark:text-warm-400 uppercase tracking-wider">Status</th>
                                    <th class="px-4 py-3.5 text-left text-xs font-semibold text-warm-500 dark:text-warm-400 uppercase tracking-wider">Foto</th>
                                    <th class="px-4 py-3.5 text-left text-xs font-semibold text-warm-500 dark:text-warm-400 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-warm-100 dark:divide-warm-700/50">
                                @foreach($laporans as $l)
                                <tr class="hover:bg-warm-50 dark:hover:bg-warm-700/30 transition-colors">
                                    <td class="px-4 py-3.5 text-warm-600 dark:text-warm-300">{{ $l->tanggal }}</td>
                                    <td class="px-4 py-3.5 text-warm-900 dark:text-warm-50 font-medium">{{ $l->kegiatan }}</td>
                                    <td class="px-4 py-3.5 text-warm-500 dark:text-warm-400 max-w-xs truncate">{{ Str::limit($l->deskripsi, 60) }}</td>
                                    <td class="px-4 py-3.5">
                                        @php
                                            $statusColors = ['pending' => 'bg-amber-50 text-amber-700 dark:bg-amber-500/10 dark:text-amber-400 border border-amber-200 dark:border-amber-500/20', 'disetujui' => 'bg-emerald-50 text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-500/20', 'ditolak' => 'bg-red-50 text-red-700 dark:bg-red-500/10 dark:text-red-400 border border-red-200 dark:border-red-500/20'];
                                        @endphp
                                        <span class="px-2.5 py-1 rounded-full text-xs font-semibold tracking-wide {{ $statusColors[$l->status] ?? 'bg-warm-100 text-warm-600 dark:bg-warm-700 dark:text-warm-300' }}">
                                            {{ ucfirst($l->status) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3.5">
                                        @if($l->foto)
                                            <img src="/{{ $l->foto }}" class="w-11 h-11 object-cover rounded-lg border border-warm-200 dark:border-warm-700 cursor-pointer hover:opacity-80 transition-opacity" onclick="openLightbox('/{{ $l->foto }}')">
                                        @else
                                            <span class="text-warm-400 dark:text-warm-500">-</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3.5">
                                        <div class="flex gap-1.5">
                                            <a href="{{ route('laporan.show', $l) }}" class="px-2.5 py-1.5 text-xs font-medium text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-500/10 rounded-lg hover:bg-blue-100 dark:hover:bg-blue-500/20 transition-colors">Detail</a>
                                            <a href="{{ route('laporan.edit', $l) }}" class="px-2.5 py-1.5 text-xs font-medium text-amber-600 dark:text-amber-400 bg-amber-50 dark:bg-amber-500/10 rounded-lg hover:bg-amber-100 dark:hover:bg-amber-500/20 transition-colors">Edit</a>
                                            <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'hapus-laporan-{{ $l->id }}')" class="px-2.5 py-1.5 text-xs font-medium text-red-600 dark:text-red-400 bg-red-50 dark:bg-red-500/10 rounded-lg hover:bg-red-100 dark:hover:bg-red-500/20 transition-colors cursor-pointer">Hapus</button>
                                            <x-modal name="hapus-laporan-{{ $l->id }}" :show="false" focusable>
                                                <div class="p-6">
                                                    <h2 class="text-base font-semibold text-warm-900 dark:text-warm-50">Hapus Laporan</h2>
                                                    <p class="mt-2 text-sm text-warm-500 dark:text-warm-400">Apakah Anda yakin ingin menghapus laporan "<strong>{{ $l->kegiatan }}</strong>"? Tindakan ini tidak dapat dibatalkan.</p>
                                                    <div class="mt-6 flex justify-end gap-3">
                                                        <button x-on:click="$dispatch('close')" type="button" class="px-4 py-2 border border-warm-200 dark:border-warm-700 text-warm-600 dark:text-warm-300 text-sm rounded-lg hover:bg-warm-50 dark:hover:bg-warm-700 transition-colors">Batal</button>
                                                        <form action="{{ route('laporan.destroy', $l) }}" method="POST">
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
                    <div class="mt-5">
                        {{ $laporans->links() }}
                    </div>
                @else
                    <div class="text-center py-12">
                        <div class="w-14 h-14 rounded-full bg-warm-100 dark:bg-warm-700 flex items-center justify-center mx-auto mb-4">
                            <svg class="w-7 h-7 text-warm-400 dark:text-warm-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        </div>
                        <p class="text-warm-500 dark:text-warm-400 mb-4">Belum ada laporan.</p>
                        <a href="{{ route('laporan.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-gradient text-white font-medium text-sm rounded-lg shadow-sm hover:shadow transition-all duration-200">Buat Laporan Pertama</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
