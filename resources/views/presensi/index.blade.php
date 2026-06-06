<x-app-layout>
    <x-slot name="header">
        <h1 class="text-lg font-semibold text-warm-900 dark:text-warm-50">Presensi Harian</h1>
    </x-slot>

    <div class="py-8 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto space-y-6">

        @if(session('success'))
            <div class="p-4 bg-emerald-50 dark:bg-emerald-500/10 border border-emerald-200 dark:border-emerald-500/20 text-emerald-700 dark:text-emerald-400 rounded-xl text-sm">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="p-4 bg-red-50 dark:bg-red-500/10 border border-red-200 dark:border-red-500/20 text-red-700 dark:text-red-400 rounded-xl text-sm">{{ session('error') }}</div>
        @endif

        <div class="bg-white dark:bg-warm-800 rounded-xl border border-warm-200 dark:border-warm-700 shadow-sm overflow-hidden">
            <div class="p-5 sm:p-6">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-5">
                    <h3 class="text-base font-semibold text-warm-900 dark:text-warm-50">Riwayat Presensi</h3>
                    <a href="{{ route('presensi.create') }}" class="inline-flex items-center px-3.5 py-2 bg-blue-gradient text-white font-medium text-xs rounded-lg shadow-sm hover:shadow transition-all duration-200">
                        <svg class="w-3.5 h-3.5 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        Isi Presensi
                    </a>
                </div>

                <form method="GET" action="{{ route('presensi.index') }}" class="mb-5 flex gap-3 items-end">
                    <div>
                        <label class="block text-xs font-medium text-warm-500 dark:text-warm-400 mb-1">Bulan</label>
                        <input type="month" name="bulan" value="{{ request('bulan', date('Y-m')) }}" class="rounded-lg border border-warm-200 dark:border-warm-700 bg-white dark:bg-warm-800 px-3 py-2 text-sm text-warm-900 dark:text-warm-50 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all">
                    </div>
                    <button type="submit" class="px-4 py-2 bg-blue-gradient text-white font-medium text-sm rounded-lg shadow-sm hover:shadow transition-all">Filter</button>
                </form>

                @if($presensis->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead>
                                <tr class="border-b border-warm-200 dark:border-warm-700">
                                    <th class="px-4 py-3.5 text-left text-xs font-semibold text-warm-500 dark:text-warm-400 uppercase tracking-wider">Tanggal</th>
                                    <th class="px-4 py-3.5 text-left text-xs font-semibold text-warm-500 dark:text-warm-400 uppercase tracking-wider">Status</th>
                                    <th class="px-4 py-3.5 text-left text-xs font-semibold text-warm-500 dark:text-warm-400 uppercase tracking-wider">Keterangan</th>
                                    <th class="px-4 py-3.5 text-left text-xs font-semibold text-warm-500 dark:text-warm-400 uppercase tracking-wider">Foto</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-warm-100 dark:divide-warm-700/50">
                                @foreach($presensis as $p)
                                <tr class="hover:bg-warm-50 dark:hover:bg-warm-700/30 transition-colors">
                                    <td class="px-4 py-3.5 text-warm-600 dark:text-warm-300">{{ $p->tanggal }}</td>
                                    <td class="px-4 py-3.5">
                                        @php
                                            $statusColors = ['hadir' => 'bg-emerald-50 text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-500/20', 'sakit' => 'bg-amber-50 text-amber-700 dark:bg-amber-500/10 dark:text-amber-400 border border-amber-200 dark:border-amber-500/20', 'izin' => 'bg-blue-50 text-blue-700 dark:bg-blue-500/10 dark:text-blue-400 border border-blue-200 dark:border-blue-500/20', 'alpha' => 'bg-red-50 text-red-700 dark:bg-red-500/10 dark:text-red-400 border border-red-200 dark:border-red-500/20'];
                                        @endphp
                                        <span class="px-2.5 py-1 rounded-full text-xs font-semibold tracking-wide {{ $statusColors[$p->status] ?? 'bg-warm-100 text-warm-600 dark:bg-warm-700 dark:text-warm-300' }}">
                                            {{ ucfirst($p->status) }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3.5 text-warm-500 dark:text-warm-400">{{ $p->keterangan ?? '-' }}</td>
                                    <td class="px-4 py-3.5">
                                        @if($p->foto)
                                            <img src="/{{ $p->foto }}" class="w-11 h-11 object-cover rounded-lg border border-warm-200 dark:border-warm-700 cursor-pointer hover:opacity-80 transition-opacity" onclick="openLightbox('/{{ $p->foto }}')">
                                        @else
                                            <span class="text-warm-400 dark:text-warm-500">-</span>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-5">{{ $presensis->links() }}</div>
                @else
                    <div class="text-center py-12">
                        <div class="w-14 h-14 rounded-full bg-warm-100 dark:bg-warm-700 flex items-center justify-center mx-auto mb-4">
                            <svg class="w-7 h-7 text-warm-400 dark:text-warm-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                        </div>
                        <p class="text-warm-500 dark:text-warm-400">Belum ada data presensi.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
