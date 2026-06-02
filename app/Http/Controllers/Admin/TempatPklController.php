<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TempatPkl;
use Illuminate\Http\Request;

class TempatPklController extends Controller
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
        $tempatPkls = TempatPkl::orderBy('nama_perusahaan')->paginate(10);
        return view('admin.tempat-pkl.index', compact('tempatPkls'));
    }

    public function create()
    {
        return view('admin.tempat-pkl.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'alamat' => 'required|string',
            'kontak' => 'nullable|string|max:255',
        ]);

        TempatPkl::create($validated);

        return redirect()->route('admin.tempat-pkl.index')
            ->with('success', 'Tempat PKL berhasil ditambahkan.');
    }

    public function show(TempatPkl $tempatPkl)
    {
        $tempatPkl->loadCount('users');
        return view('admin.tempat-pkl.show', compact('tempatPkl'));
    }

    public function edit(TempatPkl $tempatPkl)
    {
        return view('admin.tempat-pkl.edit', compact('tempatPkl'));
    }

    public function update(Request $request, TempatPkl $tempatPkl)
    {
        $validated = $request->validate([
            'nama_perusahaan' => 'required|string|max:255',
            'alamat' => 'required|string',
            'kontak' => 'nullable|string|max:255',
        ]);

        $tempatPkl->update($validated);

        return redirect()->route('admin.tempat-pkl.index')
            ->with('success', 'Tempat PKL berhasil diperbarui.');
    }

    public function destroy(TempatPkl $tempatPkl)
    {
        $tempatPkl->delete();

        return redirect()->route('admin.tempat-pkl.index')
            ->with('success', 'Tempat PKL berhasil dihapus.');
    }
}
