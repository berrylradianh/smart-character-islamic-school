<!DOCTYPE html>
<html>

<head>
    <title>Daftar Pendaftar</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #e9ecef;
            font-weight: bold;
        }

        h1 {
            text-align: center;
        }
    </style>
</head>

<body>
    <h1>Daftar Pendaftar PPDB</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Jenjang</th>
                <th>Nama Anak</th>
                <th>Nama Ayah Kandung/Wali</th>
                <th>Nama Ibu Kandung/Wali</th>
                <th>No HP Orang Tua/Wali</th>
                <th>Jadwal Tes</th>
                <th>Lokasi Tes</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @php
            $statusMap = [
            'waiting' => 'Proses',
            'decline' => 'Tidak Lolos',
            'approve' => 'Lolos',
            'accepted' => 'Diterima',
            'not_accepted' => 'Tidak Diterima',
            ];
            @endphp
            @foreach ($registrations as $index => $registration)
            <tr>
                <td>{{ $registration->user->id }}</td>
                <td>{{ $registration->user->level ? strtoupper($registration->user->level->name) : 'Belum Ditentukan' }}</td>
                <td>{{ $registration->user->name ?? 'Tidak Ada' }}</td>
                <td>{{ $registration->user->nama_ayah ?? $registration->user->nama_ayah_wali ?? 'Tidak Tersedia' }}</td>
                <td>{{ $registration->user->nama_ibu ?? $registration->user->nama_ibu_wali ?? 'Tidak Tersedia' }}</td>
                <td>{{ $registration->user->telepon_ortu ?? $registration->user->telepon_wali ?? 'Tidak Tersedia' }}</td>
                <td>{{ $registration->jadwal_tes ? \Carbon\Carbon::parse($registration->jadwal_tes)->format('d F Y H:i') : 'Belum Ditentukan' }}</td>
                <td>{{ $registration->schoolLocation ? $registration->schoolLocation->nama_lokasi : 'Belum Ditentukan' }}</td>
                <td>{{ $statusMap[$registration->status] ?? ucfirst($registration->status) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
