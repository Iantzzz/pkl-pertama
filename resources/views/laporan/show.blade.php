<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-serif text-2xl font-bold text-warm-900 dark:text-warm-50">
                {{ __('Detail Laporan') }}
            </h2>
            <p class="text-sm text-warm-500 dark:text-gold-300/70 mt-0.5">Informasi lengkap laporan kegiatan</p>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <a href="{{ route('laporan.index') }}" class="inline-flex items-center text-sm text-gold-600 dark:text-gold-300 hover:text-gold-500 transition-colors">
                <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                Kembali ke daftar
            </a>

            <div class="rounded-2xl bg-white dark:bg-warm-900 shadow-warm dark:shadow-warm-lg border border-warm-200 dark:border-gold-500/10 p-6 sm:p-8">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-semibold text-gold-600 dark:text-gold-300 uppercase tracking-wider mb-1">Tanggal</label>
                        <p class="text-warm-700 dark:text-warm-300">{{ $laporan->tanggal }}</p>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gold-600 dark:text-gold-300 uppercase tracking-wider mb-1">Kegiatan</label>
                        <p class="text-warm-700 dark:text-warm-300 font-medium">{{ $laporan->kegiatan }}</p>
                    </div>
                    <div class="sm:col-span-2">
                        <label class="block text-xs font-semibold text-gold-600 dark:text-gold-300 uppercase tracking-wider mb-1">Deskripsi</label>
                        <div class="text-warm-700 dark:text-warm-300 whitespace-pre-line bg-gold-500/5 dark:bg-gold-500/5 rounded-xl p-4 border border-gold-500/10 dark:border-gold-500/20">{!! $laporan->deskripsi !!}</div>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-gold-600 dark:text-gold-300 uppercase tracking-wider mb-1">Status</label>
                        @php
                            $statusColors = ['pending' => 'bg-amber-100 text-amber-800 dark:bg-amber-500/20 dark:text-amber-400', 'disetujui' => 'bg-emerald-100 text-emerald-800 dark:bg-emerald-500/20 dark:text-emerald-400', 'ditolak' => 'bg-red-100 text-red-800 dark:bg-red-500/20 dark:text-red-400'];
                        @endphp
                        <span class="px-3 py-1 rounded-full text-xs font-semibold tracking-wide inline-block {{ $statusColors[$laporan->status] ?? 'bg-warm-100 dark:bg-warm-700 text-warm-500 dark:text-warm-300' }}">
                            {{ ucfirst($laporan->status) }}
                        </span>
                    </div>
                    @if($laporan->nilai)
                    <div>
                        <label class="block text-xs font-semibold text-gold-600 dark:text-gold-300 uppercase tracking-wider mb-1">Nilai</label>
                        <span class="text-xl font-bold {{ $laporan->nilai >= 75 ? 'text-emerald-600 dark:text-emerald-400' : ($laporan->nilai >= 60 ? 'text-amber-600 dark:text-amber-400' : 'text-red-600 dark:text-red-400') }}">
                            {{ $laporan->nilai }}
                        </span>
                    </div>
                    @endif
                    @if($laporan->catatan_guru)
                    <div class="sm:col-span-2">
                        <label class="block text-xs font-semibold text-gold-600 dark:text-gold-300 uppercase tracking-wider mb-1">Catatan Guru</label>
                        <p class="text-warm-600 dark:text-warm-400 bg-gold-500/5 dark:bg-gold-500/5 rounded-xl p-4 border border-gold-500/10 dark:border-gold-500/20">{{ $laporan->catatan_guru }}</p>
                    </div>
                    @endif
                    <div class="sm:col-span-2">
                        <label class="block text-xs font-semibold text-gold-600 dark:text-gold-300 uppercase tracking-wider mb-1">Foto</label>
                        @if($laporan->foto)
                            <img src="{{ asset('storage/' . $laporan->foto) }}" class="max-w-md rounded-xl border border-gold-500/20 shadow-gold-sm">
                        @else
                            <p class="text-warm-400 dark:text-gold-300/30">Tidak ada foto</p>
                        @endif
                    </div>
                </div>

                @if(Auth::user()->role === 'admin')
                    <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="p-4 bg-gold-500/5 dark:bg-gold-500/5 rounded-xl border border-gold-500/10 dark:border-gold-500/20">
                            <h4 class="font-semibold text-warm-900 dark:text-warm-50 mb-3 text-sm">Ubah Status</h4>
                            <form action="{{ route('laporan.status', $laporan) }}" method="POST" class="flex gap-2">
                                @csrf
                                @method('PATCH')
                                <select name="status" class="rounded-xl border border-warm-200 dark:border-warm-700 bg-white dark:bg-warm-800 text-sm text-warm-900 dark:text-warm-50 focus:border-gold-500 focus:ring-2 focus:ring-gold-500/30 transition-all">
                                    <option value="disetujui" {{ $laporan->status === 'disetujui' ? 'selected' : '' }}>Disetujui</option>
                                    <option value="ditolak" {{ $laporan->status === 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                                </select>
                                <button type="submit" class="px-4 py-2 bg-gold-gradient text-warm-900 font-semibold text-xs rounded-xl shadow-gold-sm hover:shadow-gold transition-all duration-200">Simpan</button>
                            </form>
                        </div>

                        <div class="p-4 bg-gold-500/5 dark:bg-gold-500/5 rounded-xl border border-gold-500/10 dark:border-gold-500/20">
                            <h4 class="font-semibold text-warm-900 dark:text-warm-50 mb-3 text-sm">Nilai & Catatan</h4>
                            <form action="{{ route('laporan.nilai', $laporan) }}" method="POST" class="space-y-3">
                                @csrf
                                @method('PATCH')
                                <div class="flex gap-3 items-start">
                                    <div>
                                        <label class="block text-xs text-warm-500 dark:text-gold-300/70 mb-1">Nilai (0-100)</label>
                                        <input type="number" name="nilai" min="0" max="100" value="{{ old('nilai', $laporan->nilai) }}" class="w-20 rounded-xl border border-warm-200 dark:border-warm-700 bg-white dark:bg-warm-800 text-sm text-warm-900 dark:text-warm-50 focus:border-gold-500 focus:ring-2 focus:ring-gold-500/30 transition-all">
                                    </div>
                                    <div class="flex-1">
                                        <label class="block text-xs text-warm-500 dark:text-gold-300/70 mb-1">Catatan</label>
                                        <textarea name="catatan_guru" rows="2" class="block w-full rounded-xl border border-warm-200 dark:border-warm-700 bg-white dark:bg-warm-800 text-sm text-warm-900 dark:text-warm-50 placeholder-warm-400 dark:placeholder-gold-300/30 focus:border-gold-500 focus:ring-2 focus:ring-gold-500/30 transition-all" placeholder="Catatan untuk siswa...">{{ old('catatan_guru', $laporan->catatan_guru) }}</textarea>
                                    </div>
                                </div>
                                <button type="submit" class="px-4 py-2 bg-gold-gradient text-warm-900 font-semibold text-xs rounded-xl shadow-gold-sm hover:shadow-gold transition-all duration-200">Simpan Nilai</button>
                            </form>
                        </div>
                    </div>
                @endif

                <div class="mt-6 flex gap-2">
                    <a href="{{ route('laporan.edit', $laporan) }}" class="inline-flex items-center px-4 py-2 border border-amber-500/30 dark:border-amber-500/40 text-amber-600 dark:text-amber-400 font-semibold text-xs rounded-xl hover:bg-amber-500/10 transition-all duration-200">
                        <svg class="w-3.5 h-3.5 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        Edit
                    </a>
                    <form action="{{ route('laporan.destroy', $laporan) }}" method="POST" onsubmit="return confirm('Hapus laporan ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-red-500/30 dark:border-red-500/40 text-red-600 dark:text-red-400 font-semibold text-xs rounded-xl hover:bg-red-500/10 transition-all duration-200">
                            <svg class="w-3.5 h-3.5 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            Hapus
                        </button>
                    </form>
                </div>
            </div>

            <div class="rounded-2xl bg-white dark:bg-warm-900 shadow-warm dark:shadow-warm-lg border border-warm-200 dark:border-gold-500/10 p-6 sm:p-8">
                <h3 class="font-serif text-lg font-semibold text-warm-900 dark:text-warm-50 mb-6">Komentar</h3>

                @if($laporan->comments->count() > 0)
                    <div class="space-y-4 mb-6">
                        @foreach($laporan->comments as $comment)
                            <div class="p-4 bg-gold-500/5 dark:bg-gold-500/5 rounded-xl border border-gold-500/10 dark:border-gold-500/20">
                                <div class="flex justify-between items-start mb-1">
                                    <div class="flex items-center gap-2">
                                        <div class="w-7 h-7 rounded-full bg-gold-gradient flex items-center justify-center">
                                            <span class="text-xs font-bold text-warm-900">{{ substr($comment->user->name, 0, 1) }}</span>
                                        </div>
                                        <span class="font-medium text-sm text-warm-700 dark:text-warm-200">{{ $comment->user->name }}</span>
                                    </div>
                                    <span class="text-xs text-warm-400 dark:text-gold-300/50">{{ $comment->created_at->diffForHumans() }}</span>
                                </div>
                                <p class="mt-2 text-sm text-warm-600 dark:text-gold-300/70 ml-9">{{ $comment->isi }}</p>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-6 text-warm-400 dark:text-gold-300/50 text-sm">Belum ada komentar.</div>
                @endif

                @if(Auth::user()->role === 'admin')
                    <form action="{{ route('laporan.komentar.store', $laporan) }}" method="POST" class="mt-4">
                        @csrf
                        <x-input-label for="isi" value="Tambah Komentar" class="text-gold-600 dark:text-gold-300" />
                        <textarea id="isi" name="isi" rows="3" class="mt-1.5 block w-full rounded-xl border border-warm-200 dark:border-warm-700 bg-white dark:bg-warm-800 text-sm text-warm-900 dark:text-warm-50 placeholder-warm-400 dark:placeholder-gold-300/30 focus:border-gold-500 focus:ring-2 focus:ring-gold-500/30 transition-all" required placeholder="Tulis catatan untuk siswa..."></textarea>
                        <x-input-error :messages="$errors->get('isi')" class="mt-2" />
                        <div class="mt-3">
                            <button type="submit" class="inline-flex items-center px-5 py-2.5 bg-gold-gradient text-warm-900 font-semibold text-sm rounded-xl shadow-gold-sm hover:shadow-gold transition-all duration-200">
                                <svg class="w-4 h-4 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                                Kirim Komentar
                            </button>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
