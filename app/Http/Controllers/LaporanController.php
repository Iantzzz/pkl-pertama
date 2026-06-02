<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Laporan;
use App\Notifications\KomentarBaru;
use App\Notifications\LaporanVerified;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use OpenSpout\Common\Entity\Row;
use OpenSpout\Writer\XLSX\Writer;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $query = Laporan::where('user_id', auth()->id());

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('kegiatan', 'like', '%' . $request->search . '%')
                  ->orWhere('deskripsi', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('tanggal_from')) {
            $query->whereDate('tanggal', '>=', $request->tanggal_from);
        }

        if ($request->filled('tanggal_to')) {
            $query->whereDate('tanggal', '<=', $request->tanggal_to);
        }

        $laporans = $query->orderBy('tanggal', 'desc')
            ->paginate(10)
            ->appends($request->query());

        return view('laporan.index', compact('laporans'));
    }

    public function create()
    {
        return view('laporan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal'   => 'required|date',
            'kegiatan'  => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'foto'      => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $validated['user_id'] = auth()->id();

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('fotos', 'public');
        }

        Laporan::create($validated);

        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil ditambahkan.');
    }

    public function show(Laporan $laporan)
    {
        $this->authorizeView($laporan);
        return view('laporan.show', compact('laporan'));
    }

    public function edit(Laporan $laporan)
    {
        $this->authorizeView($laporan);
        return view('laporan.edit', compact('laporan'));
    }

    public function update(Request $request, Laporan $laporan)
    {
        $this->authorizeView($laporan);

        $validated = $request->validate([
            'tanggal'   => 'required|date',
            'kegiatan'  => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'foto'      => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            if ($laporan->foto) {
                Storage::disk('public')->delete($laporan->foto);
            }
            $validated['foto'] = $request->file('foto')->store('fotos', 'public');
        }

        $laporan->update($validated);

        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil diperbarui.');
    }

    public function destroy(Laporan $laporan)
    {
        $this->authorizeView($laporan);

        if ($laporan->foto) {
            Storage::disk('public')->delete($laporan->foto);
        }

        $laporan->delete();

        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil dihapus.');
    }

    public function exportPdf(Request $request)
    {
        $query = Laporan::where('user_id', auth()->id());

        if (auth()->user()->role === 'admin' && $request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        if ($request->filled('tanggal_from')) {
            $query->whereDate('tanggal', '>=', $request->tanggal_from);
        }
        if ($request->filled('tanggal_to')) {
            $query->whereDate('tanggal', '<=', $request->tanggal_to);
        }

        $laporans = $query->orderBy('tanggal', 'desc')->get();
        $pdf = Pdf::loadView('laporan.pdf', compact('laporans'));

        return $pdf->download('laporan-pkl.pdf');
    }

    public function exportExcel(Request $request)
    {
        $query = Laporan::with('user')->where('user_id', auth()->id());

        if (auth()->user()->role === 'admin' && $request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        if ($request->filled('tanggal_from')) {
            $query->whereDate('tanggal', '>=', $request->tanggal_from);
        }
        if ($request->filled('tanggal_to')) {
            $query->whereDate('tanggal', '<=', $request->tanggal_to);
        }

        $laporans = $query->orderBy('tanggal', 'desc')->get();

        $writer = new Writer();
        $filename = 'laporan-pkl-' . now()->format('Ymd') . '.xlsx';
        $filepath = storage_path('app/temp/' . $filename);

        if (!is_dir(storage_path('app/temp'))) {
            mkdir(storage_path('app/temp'), 0755, true);
        }

        $writer->openToFile($filepath);

        $headerRow = Row::fromValues(['Tanggal', 'Kegiatan', 'Deskripsi', 'Status', 'Nilai']);
        $writer->addRow($headerRow);

        foreach ($laporans as $l) {
            $row = Row::fromValues([
                $l->tanggal,
                $l->kegiatan,
                strip_tags($l->deskripsi),
                $l->status,
                $l->nilai ?? '-',
            ]);
            $writer->addRow($row);
        }

        $writer->close();

        return response()->download($filepath, $filename)->deleteFileAfterSend(true);
    }

    public function updateNilai(Request $request, Laporan $laporan)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        $validated = $request->validate([
            'nilai' => 'nullable|integer|min:0|max:100',
            'catatan_guru' => 'nullable|string|max:1000',
        ]);

        $laporan->update($validated);

        return redirect()->back()->with('success', 'Nilai berhasil disimpan.');
    }

    public function storeComment(Request $request, Laporan $laporan)
    {
        $this->authorizeView($laporan);

        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        $validated = $request->validate([
            'isi' => 'required|string|max:1000',
        ]);

        $comment = Comment::create([
            'laporan_id' => $laporan->id,
            'user_id' => auth()->id(),
            'isi' => $validated['isi'],
        ]);

        if ($laporan->user_id !== auth()->id()) {
            $laporan->user->notify(new KomentarBaru($comment));
        }

        return redirect()->back()->with('success', 'Komentar berhasil ditambahkan.');
    }

    public function updateStatus(Request $request, Laporan $laporan)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        $validated = $request->validate([
            'status' => 'required|in:disetujui,ditolak',
        ]);

        $laporan->update($validated);

        $laporan->user->notify(new LaporanVerified($laporan));

        return redirect()->back()->with('success', 'Status laporan berhasil diperbarui.');
    }

    private function authorizeView(Laporan $laporan): void
    {
        if (auth()->user()->role !== 'admin' && $laporan->user_id !== auth()->id()) {
            abort(403);
        }
    }
}
