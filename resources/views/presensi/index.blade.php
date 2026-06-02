<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-serif text-2xl font-bold text-warm-900 dark:text-warm-50">
                {{ __('Presensi Harian') }}
            </h2>
            <p class="text-sm text-warm-500 dark:text-gold-300/70 mt-0.5">Catat dan pantau kehadiran Praktik Kerja Lapangan</p>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if(session('success'))
                <div class="p-4 bg-emerald-50 dark:bg-emerald-500/10 border border-emerald-200 dark:border-emerald-500/20 text-emerald-700 dark:text-emerald-400 rounded-xl text-sm">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="p-4 bg-red-50 dark:bg-red-500/10 border border-red-200 dark:border-red-500/20 text-red-700 dark:text-red-400 rounded-xl text-sm">
                    {{ session('error') }}
                </div>
            @endif

            <div class="rounded-2xl bg-white dark:bg-warm-900 shadow-warm dark:shadow-warm-lg border border-warm-200 dark:border-gold-500/10 overflow-hidden">
                <div class="p-6">
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6">
                        <h3 class="font-serif text-lg font-semibold text-warm-900 dark:text-warm-50">Riwayat Presensi</h3>
                        <a href="{{ route('presensi.create') }}" class="inline-flex items-center px-4 py-2 bg-gold-gradient text-warm-900 font-semibold text-xs rounded-xl shadow-gold-sm hover:shadow-gold transition-all duration-200">
                            <svg class="w-3.5 h-3.5 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                            Isi Presensi Hari Ini
                        </a>
                    </div>

                    <form method="GET" action="{{ route('presensi.index') }}" class="mb-6 flex gap-3 items-end">
                        <div>
                            <label class="block text-xs font-medium text-warm-600 dark:text-gold-300/70 mb-1 tracking-wide">Bulan</label>
                            <input type="month" name="bulan" value="{{ request('bulan', date('Y-m')) }}" class="rounded-xl border border-warm-200 dark:border-warm-700 bg-white dark:bg-warm-800 px-3 py-2 text-sm text-warm-900 dark:text-warm-50 focus:border-gold-500 focus:ring-2 focus:ring-gold-500/30 transition-all duration-200">
                        </div>
                        <button type="submit" class="px-4 py-2 bg-gold-gradient text-warm-900 font-semibold text-sm rounded-xl shadow-gold-sm hover:shadow-gold transition-all duration-200">Filter</button>
                    </form>

                    @if($presensis->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm">
                                <thead>
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-gold-600 dark:text-gold-300 uppercase tracking-wider bg-gold-500/10 dark:bg-gold-500/5">Tanggal</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-gold-600 dark:text-gold-300 uppercase tracking-wider bg-gold-500/10 dark:bg-gold-500/5">Status</th>
                                        <th class="px-4 py-3 text-left text-xs font-semibold text-gold-600 dark:text-gold-300 uppercase tracking-wider bg-gold-500/10 dark:bg-gold-500/5">Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-warm-100 dark:divide-gold-500/5">
                                    @foreach($presensis as $p)
                                    <tr class="hover:bg-gold-500/5 dark:hover:bg-gold-500/5 transition-colors">
                                        <td class="px-4 py-3 text-warm-700 dark:text-warm-300">{{ $p->tanggal }}</td>
                                        <td class="px-4 py-3">
                                            @php
                                                $statusColors = ['hadir' => 'bg-emerald-100 text-emerald-800 dark:bg-emerald-500/20 dark:text-emerald-400', 'sakit' => 'bg-amber-100 text-amber-800 dark:bg-amber-500/20 dark:text-amber-400', 'izin' => 'bg-blue-100 text-blue-800 dark:bg-blue-500/20 dark:text-blue-400', 'alpha' => 'bg-red-100 text-red-800 dark:bg-red-500/20 dark:text-red-400'];
                                            @endphp
                                            <span class="px-3 py-1 rounded-full text-xs font-semibold tracking-wide {{ $statusColors[$p->status] ?? 'bg-warm-100 dark:bg-warm-700 text-warm-500 dark:text-warm-300' }}">
                                                {{ ucfirst($p->status) }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 text-warm-500 dark:text-gold-300/70">{{ $p->keterangan ?? '-' }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4">
                            {{ $presensis->links() }}
                        </div>
                    @else
                        <div class="text-center py-12">
                            <div class="w-16 h-16 rounded-full bg-gold-500/10 dark:bg-gold-500/10 flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-gold-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                            </div>
                            <p class="text-warm-500 dark:text-gold-300/70">Belum ada data presensi.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
