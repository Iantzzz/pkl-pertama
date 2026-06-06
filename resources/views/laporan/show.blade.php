<x-app-layout>
    <x-slot name="header">
        <h1 class="text-lg font-semibold text-warm-900 dark:text-warm-50">Detail Laporan</h1>
    </x-slot>

    <div class="py-8 px-4 sm:px-6 lg:px-8 max-w-4xl mx-auto space-y-6">

        <a href="{{ route('laporan.index') }}" class="inline-flex items-center text-sm text-warm-500 dark:text-warm-400 hover:text-warm-700 dark:hover:text-warm-200 transition-colors">
            <svg class="w-4 h-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Kembali
        </a>

        <div class="bg-white dark:bg-warm-800 rounded-xl border border-warm-200 dark:border-warm-700 shadow-sm p-6 sm:p-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-semibold text-warm-500 dark:text-warm-400 uppercase tracking-wider mb-1">Tanggal</label>
                    <p class="text-warm-900 dark:text-warm-50">{{ $laporan->tanggal }}</p>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-warm-500 dark:text-warm-400 uppercase tracking-wider mb-1">Kegiatan</label>
                    <p class="text-warm-900 dark:text-warm-50 font-medium">{{ $laporan->kegiatan }}</p>
                </div>
                <div class="sm:col-span-2">
                    <label class="block text-xs font-semibold text-warm-500 dark:text-warm-400 uppercase tracking-wider mb-1">Deskripsi</label>
                    <div class="text-warm-700 dark:text-warm-300 whitespace-pre-line bg-warm-50 dark:bg-warm-700/30 rounded-xl p-4 border border-warm-200 dark:border-warm-700">{!! $laporan->deskripsi !!}</div>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-warm-500 dark:text-warm-400 uppercase tracking-wider mb-1">Status</label>
                    @php
                        $statusColors = ['pending' => 'bg-amber-50 text-amber-700 dark:bg-amber-500/10 dark:text-amber-400 border border-amber-200 dark:border-amber-500/20', 'disetujui' => 'bg-emerald-50 text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-500/20', 'ditolak' => 'bg-red-50 text-red-700 dark:bg-red-500/10 dark:text-red-400 border border-red-200 dark:border-red-500/20'];
                    @endphp
                    <span class="px-3 py-1 rounded-full text-xs font-semibold tracking-wide inline-block {{ $statusColors[$laporan->status] ?? 'bg-warm-100 text-warm-600 dark:bg-warm-700 dark:text-warm-300' }}">
                        {{ ucfirst($laporan->status) }}
                    </span>
                </div>
                @if($laporan->nilai)
                <div>
                    <label class="block text-xs font-semibold text-warm-500 dark:text-warm-400 uppercase tracking-wider mb-1">Nilai</label>
                    <span class="text-xl font-bold {{ $laporan->nilai >= 75 ? 'text-emerald-600 dark:text-emerald-400' : ($laporan->nilai >= 60 ? 'text-amber-600 dark:text-amber-400' : 'text-red-600 dark:text-red-400') }}">
                        {{ $laporan->nilai }}
                    </span>
                </div>
                @endif
                @if($laporan->catatan_guru)
                <div class="sm:col-span-2">
                    <label class="block text-xs font-semibold text-warm-500 dark:text-warm-400 uppercase tracking-wider mb-1">Catatan Guru</label>
                    <p class="text-warm-600 dark:text-warm-300 bg-warm-50 dark:bg-warm-700/30 rounded-xl p-4 border border-warm-200 dark:border-warm-700">{{ $laporan->catatan_guru }}</p>
                </div>
                @endif
                <div class="sm:col-span-2">
                    <label class="block text-xs font-semibold text-warm-500 dark:text-warm-400 uppercase tracking-wider mb-1">Foto</label>
                    @if($laporan->foto)
                        <img src="/{{ $laporan->foto }}" class="max-w-md rounded-xl border border-warm-200 dark:border-warm-700 shadow-sm cursor-pointer hover:opacity-90 transition-opacity" onclick="openLightbox('/{{ $laporan->foto }}')">
                    @else
                        <p class="text-warm-400 dark:text-warm-500">Tidak ada foto</p>
                    @endif
                </div>
            </div>

            @if(Auth::user()->role === 'admin')
                <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="p-4 bg-warm-50 dark:bg-warm-700/30 rounded-xl border border-warm-200 dark:border-warm-700">
                        <h4 class="font-semibold text-warm-900 dark:text-warm-50 mb-3 text-sm">Ubah Status</h4>
                        <form action="{{ route('laporan.status', $laporan) }}" method="POST" class="flex gap-2">
                            @csrf
                            @method('PATCH')
                            <select name="status" class="rounded-lg border border-warm-200 dark:border-warm-700 bg-white dark:bg-warm-800 text-sm text-warm-900 dark:text-warm-50 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all">
                                <option value="disetujui" {{ $laporan->status === 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                                <option value="ditolak" {{ $laporan->status === 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                            </select>
                            <button type="submit" class="px-3 py-2 bg-blue-gradient text-white font-semibold text-xs rounded-lg shadow-sm hover:shadow transition-all">Simpan</button>
                        </form>
                    </div>

                    <div class="p-4 bg-warm-50 dark:bg-warm-700/30 rounded-xl border border-warm-200 dark:border-warm-700">
                        <h4 class="font-semibold text-warm-900 dark:text-warm-50 mb-3 text-sm">Nilai & Catatan</h4>
                        <form action="{{ route('laporan.nilai', $laporan) }}" method="POST" class="space-y-3">
                            @csrf @method('PATCH')
                            <div class="flex gap-3 items-start">
                                <div>
                                    <label class="block text-xs text-warm-500 dark:text-warm-400 mb-1">Nilai</label>
                                    <input type="number" name="nilai" min="0" max="100" value="{{ old('nilai', $laporan->nilai) }}" class="w-20 rounded-lg border border-warm-200 dark:border-warm-700 bg-white dark:bg-warm-800 text-sm text-warm-900 dark:text-warm-50 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20">
                                </div>
                                <div class="flex-1">
                                    <label class="block text-xs text-warm-500 dark:text-warm-400 mb-1">Catatan</label>
                                    <textarea name="catatan_guru" rows="2" class="block w-full rounded-lg border border-warm-200 dark:border-warm-700 bg-white dark:bg-warm-800 text-sm text-warm-900 dark:text-warm-50 placeholder-warm-400 dark:placeholder-warm-500 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20" placeholder="Catatan untuk siswa...">{{ old('catatan_guru', $laporan->catatan_guru) }}</textarea>
                                </div>
                            </div>
                            <button type="submit" class="px-3 py-2 bg-blue-gradient text-white font-semibold text-xs rounded-lg shadow-sm hover:shadow transition-all">Simpan Nilai</button>
                        </form>
                    </div>
                </div>
            @endif

            <div class="mt-6 flex gap-2">
                <a href="{{ route('laporan.edit', $laporan) }}" class="inline-flex items-center px-3.5 py-2 border border-warm-200 dark:border-warm-700 text-amber-600 dark:text-amber-400 font-medium text-xs rounded-lg hover:bg-amber-50 dark:hover:bg-amber-500/10 transition-colors">
                    <svg class="w-3.5 h-3.5 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    Edit
                </a>
                <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'hapus-laporan')" class="inline-flex items-center px-3.5 py-2 border border-warm-200 dark:border-warm-700 text-red-600 dark:text-red-400 font-medium text-xs rounded-lg hover:bg-red-50 dark:hover:bg-red-500/10 transition-colors cursor-pointer">
                    <svg class="w-3.5 h-3.5 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                    Hapus
                </button>
                <x-modal name="hapus-laporan" :show="false" focusable>
                    <div class="p-6">
                        <h2 class="text-base font-semibold text-warm-900 dark:text-warm-50">Hapus Laporan</h2>
                        <p class="mt-2 text-sm text-warm-500 dark:text-warm-400">Apakah Anda yakin ingin menghapus laporan "<strong>{{ $laporan->kegiatan }}</strong>"? Tindakan ini tidak dapat dibatalkan.</p>
                        <div class="mt-6 flex justify-end gap-3">
                            <button x-on:click="$dispatch('close')" type="button" class="px-4 py-2 border border-warm-200 dark:border-warm-700 text-warm-600 dark:text-warm-300 text-sm rounded-lg hover:bg-warm-50 dark:hover:bg-warm-700 transition-colors">Batal</button>
                            <form action="{{ route('laporan.destroy', $laporan) }}" method="POST">
                                @csrf @method('DELETE')
                                <button type="submit" class="px-4 py-2 bg-red-600 text-white text-sm rounded-lg hover:bg-red-500 transition-colors">Ya, Hapus</button>
                            </form>
                        </div>
                    </div>
                </x-modal>
            </div>
        </div>

        <div class="bg-white dark:bg-warm-800 rounded-xl border border-warm-200 dark:border-warm-700 shadow-sm p-6 sm:p-8">
            <h3 class="text-base font-semibold text-warm-900 dark:text-warm-50 mb-6">Komentar</h3>

            @if($laporan->comments->count() > 0)
                <div class="space-y-4 mb-6">
                    @foreach($laporan->comments as $comment)
                        <div class="p-4 bg-warm-50 dark:bg-warm-700/30 rounded-xl border border-warm-200 dark:border-warm-700">
                            <div class="flex justify-between items-start mb-1">
                                <div class="flex items-center gap-2.5">
                                    <div class="w-7 h-7 rounded-full bg-blue-gradient flex items-center justify-center flex-shrink-0">
                                        <span class="text-xs font-bold text-white">{{ substr($comment->user->name, 0, 1) }}</span>
                                    </div>
                                    <span class="font-medium text-sm text-warm-700 dark:text-warm-200">{{ $comment->user->name }}</span>
                                </div>
                                <span class="text-xs text-warm-400 dark:text-warm-500">{{ $comment->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="mt-2 text-sm text-warm-600 dark:text-warm-300 ml-9.5">{{ $comment->isi }}</p>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-6 text-warm-400 dark:text-warm-500 text-sm">Belum ada komentar.</div>
            @endif

            @if(Auth::user()->role === 'admin')
                <form action="{{ route('laporan.komentar.store', $laporan) }}" method="POST">
                    @csrf
                    <x-input-label for="isi" value="Tambah Komentar" />
                    <textarea id="isi" name="isi" rows="3" class="mt-1.5 block w-full rounded-lg border border-warm-200 dark:border-warm-700 bg-white dark:bg-warm-800 text-sm text-warm-900 dark:text-warm-50 placeholder-warm-400 dark:placeholder-warm-500 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20" required placeholder="Tulis catatan untuk siswa..."></textarea>
                    <x-input-error :messages="$errors->get('isi')" class="mt-2" />
                    <div class="mt-3">
                        <x-primary-button>
                            <svg class="w-4 h-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                            Kirim
                        </x-primary-button>
                    </div>
                </form>
            @endif
        </div>
    </div>
</x-app-layout>
