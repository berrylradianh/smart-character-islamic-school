<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kartu Peserta PPDB</title>
    <style>
        @page {
            size: A5 portrait;
            margin: 0;
        }
        body {
            font-family: Arial, sans-serif;
            margin: 0 5mm 5mm 0; /* Left margin 0, others reduced */
            padding: 5mm;
            width: 148mm; /* A5 width */
            height: 210mm; /* A5 height */
            box-sizing: border-box;
        }
        .container {
            text-align: center;
            width: 100%;
            max-width: 138mm; /* Adjusted to fit within margins */
        }
        .header img {
            width: 20mm;
            height: 20mm;
        }
        .header h1 {
            font-size: 14pt;
            margin: 5px 0;
        }
        .header h2 {
            font-size: 10pt;
            margin: 5px 0;
        }
        .header p {
            font-size: 8pt;
            margin: 5px 0;
            line-height: 1.2;
        }
        .line {
            border-top: 1px solid #000;
            margin: 8px 0;
        }
        .content {
            text-align: left;
            position: relative;
            min-height: 100mm;
        }
        .photo {
            position: absolute;
            top: 0;
            right: 0;
            width: 30mm;
            height: 30mm;
            object-fit: cover;
        }
        .details h3 {
            font-size: 12pt;
            text-transform: uppercase;
            margin: 8px 0 5px;
        }
        .details table {
            width: 100%;
            border-collapse: collapse;
            font-size: 10pt;
        }
        .details table td {
            padding: 3px 0;
            border: 0; /* No borders */
            vertical-align: middle; /* Center vertically for all cells */
        }
        .details table td:first-child {
            width: 80px; /* Fixed width for labels */
            font-weight: bold;
        }
        .details table td:nth-child(2) {
            width: 10px; /* Narrow column for colons */
            text-align: center; /* Center horizontally */
            vertical-align: middle; /* Center vertically */
        }
        .footer {
            position: absolute;
            bottom: 5mm;
            width: 100%;
            text-align: center;
            font-size: 8pt;
            font-style: italic;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            @if (file_exists($logo_path))
                <img src="{{ $logo_path }}" alt="Logo">
            @endif
            <h1>Kartu Peserta PPDB</h1>
            <h2>Smart Character Islamic School</h2>
            <p>Sindangreret RT. 02 RW. 04, Blok Situ Bojong, Tamanjaya, Kec. Tamansari, Kota Tasikmalaya, Jawa Barat 46196</p>
        </div>
        <div class="line"></div>
        <div class="content">
            @if ($pasfoto_path && file_exists($pasfoto_path))
                <img src="{{ $pasfoto_path }}" class="photo" alt="Pas Foto">
            @endif
            <div class="details">
                <h3>{{ $user->name ?? 'Tidak diisi' }}</h3>
                <table>
                    <tr>
                        <td>Nama Panggilan</td>
                        <td>:</td>
                        <td>{{ $user->nama_panggilan ?? 'Belum ditentukan' }}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>:</td>
                        <td>{{ $user->email ?? 'Belum ditentukan' }}</td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td>:</td>
                        <td>{{ $user->jenis_kelamin ?? 'Belum ditentukan' }}</td>
                    </tr>
                    <tr>
                        <td>Agama</td>
                        <td>:</td>
                        <td>{{ $user->agama ?? 'Belum ditentukan' }}</td>
                    </tr>
                    <tr>
                        <td>NISN</td>
                        <td>:</td>
                        <td>{{ $user->nisn ?? 'Belum ditentukan' }}</td>
                    </tr>
                    <tr>
                        <td>Tanggal Lahir</td>
                        <td>:</td>
                        <td>{{ $user->tanggal_lahir ? \Carbon\Carbon::parse($user->tanggal_lahir)->format('d F Y') : 'Tidak diisi' }}</td>
                    </tr>
                    <tr>
                        <td>No Handphone</td>
                        <td>:</td>
                        <td>{{ $user->no_hp ?? 'Belum ditentukan' }}</td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>:</td>
                        <td>{{ $user->alamat ?? 'Belum ditentukan' }}</td>
                    </tr>
                    <tr>
                        <td>Jenjang</td>
                        <td>:</td>
                        <td>{{ $user->level ? strtoupper($user->level->name) : 'Belum diatur' }}</td>
                    </tr>
                    <tr>
                        <td>Nama Ayah</td>
                        <td>:</td>
                        <td>{{ $user->nama_ayah ?? 'Belum diatur' }}</td>
                    </tr>
                    <tr>
                        <td>Nama Ibu</td>
                        <td>:</td>
                        <td>{{ $user->nama_ibu ?? 'Belum diatur' }}</td>
                    </tr>
                    <tr>
                        <td>No Handphone Orang Tua</td>
                        <td>:</td>
                        <td>{{ $user->telepon_ortu ?? 'Belum diatur' }}</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="footer">
            © SCIS, 2025. Silakan bawa kartu ini pada saat daftar ulang.
        </div>
    </div>
</body>
</html>
