<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan PKL</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #333; padding: 6px 8px; text-align: left; }
        th { background: #eee; font-weight: bold; }
        h1 { font-size: 18px; text-align: center; }
        .footer { margin-top: 30px; font-size: 10px; text-align: center; color: #666; }
    </style>
</head>
<body>
    <h1>Laporan PKL</h1>

    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Kegiatan</th>
                <th>Deskripsi</th>
                <th>Status</th>
                <th>Nilai</th>
            </tr>
        </thead>
        <tbody>
            @foreach($laporans as $l)
            <tr>
                <td>{{ $l->tanggal }}</td>
                <td>{{ $l->kegiatan }}</td>
                <td>{{ $l->deskripsi }}</td>
                <td>{{ ucfirst($l->status) }}</td>
                <td>{{ $l->nilai ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Dicetak pada {{ now()->format('d/m/Y H:i') }}
    </div>
</body>
</html>
