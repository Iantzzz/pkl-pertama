<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-serif text-2xl font-bold text-warm-900 dark:text-warm-50">
                {{ __('Tambah Tempat PKL') }}
            </h2>
            <p class="text-sm text-warm-500 dark:text-gold-300/70 mt-0.5">Tambahkan perusahaan tempat Praktik Kerja Lapangan baru</p>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="rounded-2xl bg-white dark:bg-warm-900 shadow-warm dark:shadow-warm-lg border border-warm-200 dark:border-gold-500/10 p-6 sm:p-8">
                <form action="{{ route('admin.tempat-pkl.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div class="sm:col-span-2">
                            <x-input-label for="nama_perusahaan" value="Nama Perusahaan" />
                            <x-text-input id="nama_perusahaan" type="text" name="nama_perusahaan" value="{{ old('nama_perusahaan') }}" class="mt-1.5 block w-full" required placeholder="PT. Contoh Abadi" />
                            <x-input-error :messages="$errors->get('nama_perusahaan')" class="mt-2" />
                        </div>

                        <div class="sm:col-span-2">
                            <x-input-label for="alamat" value="Alamat" />
                            <textarea id="alamat" name="alamat" rows="3" class="mt-1.5 block w-full rounded-xl border border-warm-200 dark:border-warm-700 bg-white dark:bg-warm-800 px-4 py-2.5 text-sm text-warm-900 dark:text-warm-50 placeholder-warm-400 dark:placeholder-gold-300/30 focus:border-gold-500 focus:ring-2 focus:ring-gold-500/30 transition-all duration-200" required placeholder="Jl. Contoh No. 123, Kota">{{ old('alamat') }}</textarea>
                            <x-input-error :messages="$errors->get('alamat')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="kontak" value="Kontak (opsional)" />
                            <x-text-input id="kontak" type="text" name="kontak" value="{{ old('kontak') }}" class="mt-1.5 block w-full" placeholder="Telp/Email/CP" />
                            <x-input-error :messages="$errors->get('kontak')" class="mt-2" />
                        </div>
                    </div>

                    <div class="flex items-center gap-4 pt-2">
                        <x-primary-button>
                            <svg class="w-4 h-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            Simpan
                        </x-primary-button>
                        <a href="{{ route('admin.tempat-pkl.index') }}" class="text-sm text-warm-500 dark:text-gold-300/70 hover:text-warm-700 dark:hover:text-gold-300 transition-colors">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
