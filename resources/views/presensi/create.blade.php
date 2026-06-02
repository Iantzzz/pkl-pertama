<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-serif text-2xl font-bold text-warm-900 dark:text-warm-50">
                {{ __('Isi Presensi') }}
            </h2>
            <p class="text-sm text-warm-500 dark:text-gold-300/70 mt-0.5">Catat kehadiran Praktik Kerja Lapangan hari ini</p>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="rounded-2xl bg-white dark:bg-warm-900 shadow-warm dark:shadow-warm-lg border border-warm-200 dark:border-gold-500/10 p-6 sm:p-8">
                @if($existing)
                    <div class="p-4 bg-amber-50 dark:bg-amber-500/10 border border-amber-200 dark:border-amber-500/20 text-amber-700 dark:text-amber-400 rounded-xl text-sm mb-4">
                        <div class="flex items-center gap-3">
                            <svg class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <span>Anda sudah mengisi presensi hari ini ({{ $existing->tanggal }}) dengan status <strong>{{ ucfirst($existing->status) }}</strong>.</span>
                        </div>
                    </div>
                    <a href="{{ route('presensi.index') }}" class="inline-flex items-center text-sm text-gold-600 dark:text-gold-300 hover:text-gold-500 transition-colors">
                        <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                        Kembali ke riwayat presensi
                    </a>
                @else
                    <div class="text-center mb-6">
                        <div class="w-16 h-16 rounded-full bg-gold-gradient flex items-center justify-center shadow-gold-sm mx-auto mb-3">
                            <svg class="w-8 h-8 text-warm-900" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <h3 class="font-serif text-lg font-semibold text-warm-900 dark:text-warm-50">Presensi Hari Ini</h3>
                        <p class="text-sm text-warm-500 dark:text-gold-300/70 mt-1">{{ $today }}</p>
                    </div>

                    <form action="{{ route('presensi.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <div>
                            <x-input-label for="status" value="Status Kehadiran" />
                            <select id="status" name="status" class="mt-1.5 block w-full rounded-xl border border-warm-200 dark:border-warm-700 bg-white dark:bg-warm-800 px-4 py-2.5 text-sm text-warm-900 dark:text-warm-50 focus:border-gold-500 focus:ring-2 focus:ring-gold-500/30 transition-all duration-200" required>
                                <option value="hadir" class="bg-white dark:bg-warm-800">Hadir</option>
                                <option value="sakit" class="bg-white dark:bg-warm-800">Sakit</option>
                                <option value="izin" class="bg-white dark:bg-warm-800">Izin</option>
                                <option value="alpha" class="bg-white dark:bg-warm-800">Alpha</option>
                            </select>
                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="keterangan" value="Keterangan (opsional)" />
                            <textarea id="keterangan" name="keterangan" rows="3" class="mt-1.5 block w-full rounded-xl border border-warm-200 dark:border-warm-700 bg-white dark:bg-warm-800 px-4 py-2.5 text-sm text-warm-900 dark:text-warm-50 placeholder-warm-400 dark:placeholder-gold-300/30 focus:border-gold-500 focus:ring-2 focus:ring-gold-500/30 transition-all duration-200" placeholder="Alasan jika sakit/izin...">{{ old('keterangan') }}</textarea>
                            <x-input-error :messages="$errors->get('keterangan')" class="mt-2" />
                        </div>

                        <div class="flex items-center gap-4 pt-2">
                            <x-primary-button>
                                <svg class="w-4 h-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                Simpan Presensi
                            </x-primary-button>
                            <a href="{{ route('presensi.index') }}" class="text-sm text-warm-500 dark:text-gold-300/70 hover:text-warm-700 dark:hover:text-gold-300 transition-colors">Batal</a>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
