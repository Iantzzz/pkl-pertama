<?php

namespace App\Http\Controllers;

use App\Models\Presensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PresensiController extends Controller
{
    public function index(Request $request)
    {
        $query = Presensi::where('user_id', auth()->id());

        if ($request->filled('bulan')) {
            $query->whereMonth('tanggal', date('m', strtotime($request->bulan)))
                  ->whereYear('tanggal', date('Y', strtotime($request->bulan)));
        }

        $presensis = $query->orderBy('tanggal', 'desc')
            ->paginate(15)
            ->appends($request->query());

        return view('presensi.index', compact('presensis'));
    }

    public function create()
    {
        $today = now()->toDateString();
        $existing = Presensi::where('user_id', auth()->id())
            ->whereDate('tanggal', $today)
            ->first();

        return view('presensi.create', compact('today', 'existing'));
    }

    public function store(Request $request)
    {
        $today = now()->toDateString();

        $existing = Presensi::where('user_id', auth()->id())
            ->whereDate('tanggal', $today)
            ->first();

        if ($existing) {
            return redirect()->route('presensi.index')
                ->with('error', 'Anda sudah mengisi presensi hari ini.');
        }

        $validated = $request->validate([
            'status' => 'required|in:hadir,sakit,izin,alpha',
            'keterangan' => 'nullable|string|max:500',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = [
            'user_id' => auth()->id(),
            'tanggal' => $today,
            'status' => $validated['status'],
            'keterangan' => $validated['keterangan'] ?? null,
        ];

        Log::info('Presensi store: hasFile(foto)=' . ($request->hasFile('foto') ? 'true' : 'false'));

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            Log::info('Presensi store: file valid=' . ($file->isValid() ? 'true' : 'false') . ' size=' . $file->getSize() . ' ext=' . $file->getClientOriginalExtension());
            $filename = time() . '_' . str_replace(' ', '_', $file->getClientOriginalName());
            $file->move(public_path('uploads/presensi'), $filename);
            $data['foto'] = 'uploads/presensi/' . $filename;
            Log::info('Presensi store: foto saved to ' . $data['foto']);
        }

        $presensi = Presensi::create($data);
        Log::info('Presensi store: created id=' . $presensi->id . ' foto=' . ($presensi->foto ?? 'null'));

        return redirect()->route('presensi.index')
            ->with('success', 'Presensi berhasil dicatat.');
    }
}
