<x-app-layout>
    <x-slot name="header">
        <h1 class="text-lg font-semibold text-warm-900 dark:text-warm-50">Tambah Laporan PKL</h1>
    </x-slot>

    <div class="py-8 px-4 sm:px-6 lg:px-8 max-w-4xl mx-auto">
        <div class="bg-white dark:bg-warm-800 rounded-xl border border-warm-200 dark:border-warm-700 shadow-sm p-6 sm:p-8">
            <form action="{{ route('laporan.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <x-input-label for="tanggal" value="Tanggal" />
                        <x-text-input id="tanggal" type="date" name="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}" class="mt-1.5 block w-full" required />
                        <x-input-error :messages="$errors->get('tanggal')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="kegiatan" value="Kegiatan" />
                        <x-text-input id="kegiatan" type="text" name="kegiatan" value="{{ old('kegiatan') }}" class="mt-1.5 block w-full" required placeholder="Mis: Memasang kabel jaringan" />
                        <x-input-error :messages="$errors->get('kegiatan')" class="mt-2" />
                    </div>
                </div>

                <div>
                    <x-input-label for="deskripsi" value="Deskripsi" />
                    <textarea id="deskripsi" name="deskripsi" rows="5" class="mt-1.5 block w-full rounded-lg border border-warm-200 dark:border-warm-700 bg-white dark:bg-warm-800 text-warm-900 dark:text-warm-50 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20" required placeholder="Jelaskan kegiatan yang dilakukan...">{{ old('deskripsi') }}</textarea>
                    <x-input-error :messages="$errors->get('deskripsi')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="foto" value="Foto Kegiatan" />
                    <div class="mt-1.5 flex items-center justify-center w-full">
                        <label class="flex flex-col items-center justify-center w-full h-32 border-2 border-dashed border-warm-200 dark:border-warm-700 rounded-xl cursor-pointer bg-warm-50 dark:bg-warm-700/30 hover:bg-blue-50 dark:hover:bg-blue-500/5 hover:border-blue-500/50 transition-all">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-8 h-8 mb-3 text-warm-400 dark:text-warm-500" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/></svg>
                                <p class="mb-1 text-sm text-warm-500 dark:text-warm-400"><span class="font-semibold">Klik untuk upload</span> atau drag and drop</p>
                                <p class="text-xs text-warm-400 dark:text-warm-500">Maksimal 2MB. Format: JPG, PNG.</p>
                            </div>
                            <input id="foto" type="file" name="foto" accept="image/jpeg,image/png,image/jpg" class="hidden" />
                        </label>
                    </div>
                    <x-input-error :messages="$errors->get('foto')" class="mt-2" />
                </div>

                <div class="flex items-center gap-4 pt-2">
                    <x-primary-button>
                        <svg class="w-4 h-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Simpan Laporan
                    </x-primary-button>
                    <a href="{{ route('laporan.index') }}" class="text-sm text-warm-500 dark:text-warm-400 hover:text-warm-700 dark:hover:text-warm-200 transition-colors">Batal</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
