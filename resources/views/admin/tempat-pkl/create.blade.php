<x-app-layout>
    <x-slot name="header">
        <h1 class="text-lg font-semibold text-warm-900 dark:text-warm-50">Tambah Tempat PKL</h1>
    </x-slot>

    <div class="py-8 px-4 sm:px-6 lg:px-8 max-w-3xl mx-auto">
        <div class="bg-white dark:bg-warm-800 rounded-xl border border-warm-200 dark:border-warm-700 shadow-sm p-6 sm:p-8">
            <form action="{{ route('admin.tempat-pkl.store') }}" method="POST" class="space-y-6">
                @csrf

                <div>
                    <x-input-label for="nama_perusahaan" value="Nama Perusahaan" />
                    <x-text-input id="nama_perusahaan" type="text" name="nama_perusahaan" value="{{ old('nama_perusahaan') }}" class="mt-1.5 block w-full" required placeholder="PT. Contoh Abadi" />
                    <x-input-error :messages="$errors->get('nama_perusahaan')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="alamat" value="Alamat" />
                    <textarea id="alamat" name="alamat" rows="3" class="mt-1.5 block w-full rounded-lg border border-warm-200 dark:border-warm-700 bg-white dark:bg-warm-800 px-4 py-2.5 text-sm text-warm-900 dark:text-warm-50 placeholder-warm-400 dark:placeholder-warm-500 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all" required placeholder="Jl. Contoh No. 123, Kota">{{ old('alamat') }}</textarea>
                    <x-input-error :messages="$errors->get('alamat')" class="mt-2" />
                </div>

                <div>
                    <x-input-label for="kontak" value="Kontak (opsional)" />
                    <x-text-input id="kontak" type="text" name="kontak" value="{{ old('kontak') }}" class="mt-1.5 block w-full" placeholder="Telp/Email/CP" />
                    <x-input-error :messages="$errors->get('kontak')" class="mt-2" />
                </div>

                <div class="flex items-center gap-4 pt-2">
                    <x-primary-button>
                        <svg class="w-4 h-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Simpan
                    </x-primary-button>
                    <a href="{{ route('admin.tempat-pkl.index') }}" class="text-sm text-warm-500 dark:text-warm-400 hover:text-warm-700 dark:hover:text-warm-200 transition-colors">Batal</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
