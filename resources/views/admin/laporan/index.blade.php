<x-app-layout>
    <x-slot name="header">
        <h1 class="text-lg font-semibold text-warm-900 dark:text-warm-50">Semua Laporan PKL</h1>
    </x-slot>

    <div class="py-8 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">

        @if(session('success'))
            <div class="mb-6 p-4 bg-emerald-50 dark:bg-emerald-500/10 border border-emerald-200 dark:border-emerald-500/20 text-emerald-700 dark:text-emerald-400 rounded-xl text-sm">{{ session('success') }}</div>
        @endif

        <div class="bg-white dark:bg-warm-800 rounded-xl border border-warm-200 dark:border-warm-700 shadow-sm overflow-hidden">
            <div class="p-5 sm:p-6">
                <h3 class="text-base font-semibold text-warm-900 dark:text-warm-50 mb-4">Daftar Laporan</h3>

                <form method="GET" action="{{ route('admin.laporan.index') }}" class="mb-5 p-4 bg-warm-50 dark:bg-warm-700/20 rounded-xl border border-warm-200 dark:border-warm-700 flex flex-wrap gap-3 items-end">
                    <div>
                        <label class="block text-xs font-medium text-warm-500 dark:text-warm-400 mb-1">Cari</label>
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari kegiatan/deskripsi..." class="rounded-lg border border-warm-200 dark:border-warm-700 bg-white dark:bg-warm-800 px-3 py-2 text-sm text-warm-900 dark:text-warm-50 placeholder-warm-400 dark:placeholder-warm-500 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-warm-500 dark:text-warm-400 mb-1">Siswa</label>
                        <select name="user_id" class="rounded-lg border border-warm-200 dark:border-warm-700 bg-white dark:bg-warm-800 px-3 py-2 text-sm text-warm-900 dark:text-warm-50 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all">
                            <option value="">Semua Siswa</option>
                            @foreach($siswas as $siswa)
                                <option value="{{ $siswa->id }}" {{ request('user_id') == $siswa->id ? 'selected' : '' }}>{{ $siswa->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-warm-500 dark:text-warm-400 mb-1">Status</label>
                        <select name="status" class="rounded-lg border border-warm-200 dark:border-warm-700 bg-white dark:bg-warm-800 px-3 py-2 text-sm text-warm-900 dark:text-warm-50 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all">
                            <option value="">Semua Status</option>
                            <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="disetujui" {{ request('status') == 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                            <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-warm-500 dark:text-warm-400 mb-1">Tanggal Dari</label>
                        <input type="date" name="tanggal_from" value="{{ request('tanggal_from') }}" class="rounded-lg border border-warm-200 dark:border-warm-700 bg-white dark:bg-warm-800 px-3 py-2 text-sm text-warm-900 dark:text-warm-50 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all">
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-warm-500 dark:text-warm-400 mb-1">Tanggal Sampai</label>
                        <input type="date" name="tanggal_to" value="{{ request('tanggal_to') }}" class="rounded-lg border border-warm-200 dark:border-warm-700 bg-white dark:bg-warm-800 px-3 py-2 text-sm text-warm-900 dark:text-warm-50 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all">
                    </div>
                    <button type="submit" class="px-4 py-2 bg-blue-gradient text-white font-medium text-sm rounded-lg shadow-sm hover:shadow transition-all">Filter</button>
                    @if(request()->anyFilled(['search', 'user_id', 'status', 'tanggal_from', 'tanggal_to']))
                        <a href="{{ route('admin.laporan.index') }}" class="px-4 py-2 border border-warm-200 dark:border-warm-700 text-warm-500 dark:text-warm-400 text-sm rounded-lg hover:bg-warm-100 dark:hover:bg-warm-700/50 transition-all">Reset</a>
                    @endif
                </form>

                @if($laporans->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="border-b border-warm-200 dark:border-warm-700">
                                    <th class="px-4 py-3.5 text-left text-xs font-semibold text-warm-500 dark:text-warm-400 uppercase tracking-wider">Siswa</th>
                                    <th class="px-4 py-3.5 text-left text-xs font-semibold text-warm-500 dark:text-warm-400 uppercase tracking-wider">Tanggal</th>
                                    <th class="px-4 py-3.5 text-left text-xs font-semibold text-warm-500 dark:text-warm-400 uppercase tracking-wider">Kegiatan</th>
                                    <th class="px-4 py-3.5 text-left text-xs font-semibold text-warm-500 dark:text-warm-400 uppercase tracking-wider">Status</th>
                                    <th class="px-4 py-3.5 text-left text-xs font-semibold text-warm-500 dark:text-warm-400 uppercase tracking-wider">Nilai</th>
                                    <th class="px-4 py-3.5 text-left text-xs font-semibold text-warm-500 dark:text-warm-400 uppercase tracking-wider">Foto</th>
                                    <th class="px-4 py-3.5 text-left text-xs font-semibold text-warm-500 dark:text-warm-400 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-warm-100 dark:divide-warm-700/50">
                                @foreach($laporans as $l)
                                <tr class="hover:bg-warm-50 dark:hover:bg-warm-700/30 transition-colors">
                                    <td class="px-4 py-3.5">
                                        <div class="flex items-center gap-2.5">
                                            <div class="w-8 h-8 rounded-full bg-blue-gradient flex items-center justify-center flex-shrink-0">
                                                <span class="text-xs font-bold text-white">{{ substr($l->user->name, 0, 1) }}</span>
                                            </div>
                                            <span class="font-medium text-warm-900 dark:text-warm-50">{{ $l->user->name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3.5 text-warm-600 dark:text-warm-300 whitespace-nowrap">{{ $l->tanggal }}</td>
                                    <td class="px-4 py-3.5 text-warm-900 dark:text-warm-50 max-w-xs truncate">{{ $l->kegiatan }}</td>
                                    <td class="px-4 py-3.5 whitespace-nowrap">
                                        @php
                                            $statusColors = ['pending' => 'bg-amber-50 text-amber-700 dark:bg-amber-500/10 dark:text-amber-400 border border-amber-200 dark:border-amber-500/20', 'disetujui' => 'bg-emerald-50 text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-500/20', 'ditolak' => 'bg-red-50 text-red-700 dark:bg-red-500/10 dark:text-red-400 border border-red-200 dark:border-red-500/20'];
                                        @endphp
                                        <span class="px-2.5 py-1 rounded-full text-xs font-semibold tracking-wide {{ $statusColors[$l->status] ?? 'bg-warm-100 text-warm-600 dark:bg-warm-700 dark:text-warm-300' }}">
                                            {{ ucfirst($l->status) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3.5 text-warm-600 dark:text-warm-300">{{ $l->nilai ?? '-' }}</td>
                                    <td class="px-4 py-3.5">
                                        @if($l->foto)
                                        <a href="/{{ $l->foto }}" data-lightbox="admin-laporan-{{ $l->id }}" data-title="{{ $l->kegiatan }}">
                                            <img src="/{{ $l->foto }}" class="w-16 h-16 object-cover rounded-lg border border-warm-200 dark:border-warm-700 cursor-pointer hover:opacity-80 transition-opacity">
                                        </a>
                                        @else
                                        <span class="text-warm-400 dark:text-warm-500 text-xs">-</span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-3.5 whitespace-nowrap">
                                        <a href="{{ route('admin.laporan.show', $l) }}" class="px-2.5 py-1.5 text-xs font-medium text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-blue-500/10 rounded-lg hover:bg-blue-100 dark:hover:bg-blue-500/20 transition-colors">Detail</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-5">{{ $laporans->links() }}</div>
                @else
                    <div class="text-center py-12">
                        <div class="w-14 h-14 rounded-full bg-warm-100 dark:bg-warm-700 flex items-center justify-center mx-auto mb-4">
                            <svg class="w-7 h-7 text-warm-400 dark:text-warm-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        </div>
                        <p class="text-warm-500 dark:text-warm-400">Belum ada laporan.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
