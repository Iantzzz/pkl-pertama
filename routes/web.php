<?php

use App\Http\Controllers\Admin\LaporanController as AdminLaporanController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    if (auth()->user()->role === 'admin') {
        $laporans = Laporan::orderBy('tanggal', 'desc')
            ->take(5)
            ->get();
    } else {
        $laporans = Laporan::where('user_id', auth()->id())
            ->orderBy('tanggal', 'desc')
            ->take(5)
            ->get();
    }

    $chartData = null;
    $chartLabels = null;

    if (auth()->user()->role === 'admin') {
        $stats = Laporan::selectRaw("MONTH(tanggal) as bulan, YEAR(tanggal) as tahun, COUNT(*) as total")
            ->groupBy('tahun', 'bulan')
            ->orderBy('tahun')
            ->orderBy('bulan')
            ->limit(12)
            ->get();

        $chartLabels = $stats->map(fn($s) => "{$s->bulan}/{$s->tahun}")->toArray();
        $chartData = $stats->pluck('total')->toArray();
    }

    return view('dashboard', compact('laporans', 'chartData', 'chartLabels'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('laporan/export/pdf', [LaporanController::class, 'exportPdf'])->name('laporan.export.pdf');
    Route::get('laporan/export/excel', [LaporanController::class, 'exportExcel'])->name('laporan.export.excel');
    Route::resource('laporan', LaporanController::class);
    Route::get('presensi', [\App\Http\Controllers\PresensiController::class, 'index'])->name('presensi.index');
    Route::get('presensi/create', [\App\Http\Controllers\PresensiController::class, 'create'])->name('presensi.create');
    Route::post('presensi', [\App\Http\Controllers\PresensiController::class, 'store'])->name('presensi.store');

    Route::patch('laporan/{laporan}/status', [LaporanController::class, 'updateStatus'])->name('laporan.status');
    Route::patch('laporan/{laporan}/nilai', [LaporanController::class, 'updateNilai'])->name('laporan.nilai');
    Route::post('laporan/{laporan}/komentar', [LaporanController::class, 'storeComment'])->name('laporan.komentar.store');

    Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
        Route::get('laporan', [AdminLaporanController::class, 'index'])->name('laporan.index');
        Route::get('laporan/{laporan}', [AdminLaporanController::class, 'show'])->name('laporan.show');
        Route::get('siswa', [\App\Http\Controllers\Admin\SiswaController::class, 'index'])->name('siswa.index');
        Route::get('siswa/{user}', [\App\Http\Controllers\Admin\SiswaController::class, 'show'])->name('siswa.show');
        Route::patch('siswa/{user}/tempat-pkl', [\App\Http\Controllers\Admin\SiswaController::class, 'updateTempatPkl'])->name('siswa.tempat-pkl');
        Route::resource('tempat-pkl', \App\Http\Controllers\Admin\TempatPklController::class);
    });
});

require __DIR__.'/auth.php';
