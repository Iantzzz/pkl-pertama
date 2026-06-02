<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TempatPkl;
use App\Models\User;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (auth()->user()->role !== 'admin') {
                abort(403);
            }
            return $next($request);
        });
    }

    public function index()
    {
        $siswas = User::where('role', 'siswa')
            ->withCount('laporans')
            ->orderBy('name')
            ->paginate(20);

        return view('admin.siswa.index', compact('siswas'));
    }

    public function show(User $user)
    {
        if ($user->role !== 'siswa') {
            abort(404);
        }

        $laporans = $user->laporans()
            ->orderBy('tanggal', 'desc')
            ->paginate(10);

        $tempatPkls = TempatPkl::orderBy('nama_perusahaan')->get();

        return view('admin.siswa.show', compact('user', 'laporans', 'tempatPkls'));
    }

    public function updateTempatPkl(Request $request, User $user)
    {
        if ($user->role !== 'siswa') {
            abort(404);
        }

        $validated = $request->validate([
            'tempat_pkl_id' => 'nullable|exists:tempat_pkl,id',
        ]);

        $user->update($validated);

        return redirect()->back()->with('success', 'Tempat PKL siswa berhasil diperbarui.');
    }
}
