<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-serif text-2xl font-bold text-warm-900 dark:text-warm-50">
                {{ __('Edit Laporan PKL') }}
            </h2>
            <p class="text-sm text-warm-500 dark:text-gold-300/70 mt-0.5">Perbarui laporan kegiatan Praktik Kerja Lapangan</p>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="rounded-2xl bg-white dark:bg-warm-900 shadow-warm dark:shadow-warm-lg border border-warm-200 dark:border-gold-500/10 p-6 sm:p-8">
                <form action="{{ route('laporan.update', $laporan) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <x-input-label for="tanggal" value="Tanggal" />
                            <x-text-input id="tanggal" type="date" name="tanggal" value="{{ old('tanggal', $laporan->tanggal) }}" class="mt-1.5 block w-full" required />
                            <x-input-error :messages="$errors->get('tanggal')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="kegiatan" value="Kegiatan" />
                            <x-text-input id="kegiatan" type="text" name="kegiatan" value="{{ old('kegiatan', $laporan->kegiatan) }}" class="mt-1.5 block w-full" required />
                            <x-input-error :messages="$errors->get('kegiatan')" class="mt-2" />
                        </div>
                    </div>

                    <div>
                        <x-input-label for="deskripsi" value="Deskripsi" />
                        <textarea id="deskripsi" name="deskripsi" rows="5" class="tinymce mt-1.5 block w-full rounded-xl border border-warm-200 dark:border-warm-700 bg-white dark:bg-warm-800 text-warm-900 dark:text-warm-50 focus:border-gold-500 focus:ring-2 focus:ring-gold-500/30" required>{{ old('deskripsi', $laporan->deskripsi) }}</textarea>
                        <x-input-error :messages="$errors->get('deskripsi')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="foto" value="Foto Kegiatan" />
                        @if($laporan->foto)
                            <div class="mt-2 mb-3 p-3 bg-gold-500/5 dark:bg-gold-500/5 rounded-xl border border-gold-500/10 dark:border-gold-500/20">
                                <img src="{{ asset('storage/' . $laporan->foto) }}" class="w-24 h-24 object-cover rounded-xl border border-gold-500/20">
                                <p class="text-xs text-gold-600 dark:text-gold-300/70 mt-1.5">Foto saat ini. Upload foto baru untuk mengganti.</p>
                            </div>
                        @endif
                        <div class="mt-1.5 flex items-center justify-center w-full">
                            <label class="flex flex-col items-center justify-center w-full h-28 border-2 border-dashed border-warm-200 dark:border-warm-700 rounded-2xl cursor-pointer bg-warm-50 dark:bg-warm-800/30 hover:bg-gold-500/5 dark:hover:bg-gold-500/5 hover:border-gold-500/50 transition-all duration-200">
                                <div class="flex flex-col items-center justify-center pt-4 pb-5">
                                    <svg class="w-7 h-7 mb-2 text-warm-400 dark:text-gold-300/50" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    <p class="text-xs text-warm-500 dark:text-gold-300/70">Klik untuk ganti foto (maks 2MB, JPG/PNG)</p>
                                </div>
                                <input id="foto" type="file" name="foto" accept="image/jpeg,image/png,image/jpg" class="hidden" />
                            </label>
                        </div>
                        <x-input-error :messages="$errors->get('foto')" class="mt-2" />
                    </div>

                    <div class="flex items-center gap-4 pt-2">
                        <x-primary-button>
                            <svg class="w-4 h-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                            Update Laporan
                        </x-primary-button>
                        <a href="{{ route('laporan.index') }}" class="text-sm text-warm-500 dark:text-gold-300/70 hover:text-warm-700 dark:hover:text-gold-300 transition-colors">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
