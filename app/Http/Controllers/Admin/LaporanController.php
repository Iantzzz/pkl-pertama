<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Laporan;
use App\Models\User;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $query = Laporan::with('user');

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('kegiatan', 'like', '%' . $request->search . '%')
                  ->orWhere('deskripsi', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('tanggal_from')) {
            $query->whereDate('tanggal', '>=', $request->tanggal_from);
        }

        if ($request->filled('tanggal_to')) {
            $query->whereDate('tanggal', '<=', $request->tanggal_to);
        }

        $laporans = $query->orderBy('tanggal', 'desc')
            ->paginate(15)
            ->appends($request->query());

        $siswas = User::where('role', 'siswa')->orderBy('name')->get();

        return view('admin.laporan.index', compact('laporans', 'siswas'));
    }

    public function show(Laporan $laporan)
    {
        $laporan->load('user', 'comments.user');
        return view('admin.laporan.show', compact('laporan'));
    }
}
