<x-app-layout>
    <x-slot name="header">
        <h1 class="text-lg font-semibold text-warm-900 dark:text-warm-50">Dashboard</h1>
    </x-slot>

    <div class="py-8 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto space-y-6">

        @if(Auth::user()->role === 'admin')
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white dark:bg-warm-800 rounded-xl border border-warm-200 dark:border-warm-700 shadow-sm p-6">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 rounded-xl bg-blue-gradient flex items-center justify-center shadow-sm flex-shrink-0">
                            <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </div>
                        <div>
                            <p class="text-sm text-warm-500 dark:text-warm-400">Total Siswa</p>
                            <p class="text-2xl font-semibold text-warm-900 dark:text-warm-50 mt-0.5">{{ \App\Models\User::where('role', 'siswa')->count() }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-warm-800 rounded-xl border border-warm-200 dark:border-warm-700 shadow-sm p-6">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-emerald-500 to-emerald-600 flex items-center justify-center shadow-sm flex-shrink-0">
                            <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        </div>
                        <div>
                            <p class="text-sm text-warm-500 dark:text-warm-400">Total Laporan</p>
                            <p class="text-2xl font-semibold text-warm-900 dark:text-warm-50 mt-0.5">{{ \App\Models\Laporan::count() }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-warm-800 rounded-xl border border-warm-200 dark:border-warm-700 shadow-sm p-6">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center shadow-sm flex-shrink-0">
                            <svg class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                        </div>
                        <div>
                            <p class="text-sm text-warm-500 dark:text-warm-400">Tempat PKL</p>
                            <p class="text-2xl font-semibold text-warm-900 dark:text-warm-50 mt-0.5">{{ \App\Models\TempatPkl::count() }}</p>
                        </div>
                    </div>
                </div>
            </div>

            @if($chartData)
                <div class="bg-white dark:bg-warm-800 rounded-xl border border-warm-200 dark:border-warm-700 shadow-sm p-6">
                    <h4 class="text-base font-semibold text-warm-900 dark:text-warm-50 mb-4">Grafik Laporan per Bulan</h4>
                    <canvas id="chartLaporan" height="100"></canvas>
                </div>
            @endif
        @else
            <div class="bg-white dark:bg-warm-800 rounded-xl border border-warm-200 dark:border-warm-700 shadow-sm p-5">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-xl bg-blue-gradient flex items-center justify-center shadow-sm flex-shrink-0">
                        <svg class="w-5 h-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <p class="text-sm text-warm-600 dark:text-warm-300">Anda login sebagai <span class="font-semibold text-warm-900 dark:text-warm-50">Siswa</span></p>
                </div>
            </div>

            <div class="flex items-center justify-between">
                <h2 class="text-lg font-semibold text-warm-900 dark:text-warm-50">Laporan Terbaru</h2>
                <a href="{{ route('laporan.create') }}" class="text-sm font-medium text-blue-600 dark:text-blue-400 hover:text-blue-500">+ Buat Baru</a>
            </div>

            @if($laporans->count() > 0)
                <div class="bg-white dark:bg-warm-800 rounded-xl border border-warm-200 dark:border-warm-700 shadow-sm overflow-hidden">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="border-b border-warm-200 dark:border-warm-700">
                                <th class="px-5 py-3.5 text-left text-xs font-semibold text-warm-500 dark:text-warm-400 uppercase tracking-wider">Tanggal</th>
                                <th class="px-5 py-3.5 text-left text-xs font-semibold text-warm-500 dark:text-warm-400 uppercase tracking-wider">Kegiatan</th>
                                <th class="px-5 py-3.5 text-left text-xs font-semibold text-warm-500 dark:text-warm-400 uppercase tracking-wider">Deskripsi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-warm-100 dark:divide-warm-700/50">
                            @foreach($laporans as $l)
                            <tr class="hover:bg-warm-50 dark:hover:bg-warm-700/30 transition-colors">
                                <td class="px-5 py-3.5 text-warm-600 dark:text-warm-300">{{ $l->tanggal }}</td>
                                <td class="px-5 py-3.5 text-warm-900 dark:text-warm-50 font-medium">{{ $l->kegiatan }}</td>
                                <td class="px-5 py-3.5 text-warm-500 dark:text-warm-400">{{ Str::limit($l->deskripsi, 50) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="bg-white dark:bg-warm-800 rounded-xl border border-warm-200 dark:border-warm-700 shadow-sm p-12 text-center">
                    <div class="w-14 h-14 rounded-full bg-blue-500/10 flex items-center justify-center mx-auto mb-4">
                        <svg class="w-7 h-7 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    <p class="text-warm-500 dark:text-warm-400 mb-4">Belum ada laporan.</p>
                    <a href="{{ route('laporan.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-gradient text-white text-sm font-semibold rounded-lg shadow-sm hover:shadow transition-all duration-200">Buat Laporan Sekarang</a>
                </div>
            @endif
        @endif
    </div>
</x-app-layout>

@push('scripts')
@if(Auth::user()->role === 'admin' && $chartData)
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('chartLaporan').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($chartLabels) !!},
            datasets: [{
                label: 'Jumlah Laporan',
                data: {!! json_encode($chartData) !!},
                backgroundColor: 'rgba(59, 130, 246, 0.6)',
                borderColor: '#3B82F6',
                borderWidth: 2,
                borderRadius: 6,
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    labels: { color: '#94A3B8' }
                }
            },
            scales: {
                y: { beginAtZero: true, ticks: { stepSize: 1, color: '#94A3B8' }, grid: { color: 'rgba(148, 163, 184, 0.1)' } },
                x: { ticks: { color: '#94A3B8' }, grid: { display: false } }
            }
        }
    });
</script>
@endif
@endpush
