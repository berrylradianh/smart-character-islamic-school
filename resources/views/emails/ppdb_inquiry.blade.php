<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Pertanyaan PPDB</title>
</head>
<body>
    <h1>Pertanyaan PPDB Baru</h1>
    <p>Berikut adalah detail pertanyaan yang diterima:</p>

    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>Nama Siswa/Anak</th>
            <td>{{ $namaSiswa }}</td>
        </tr>
        <tr>
            <th>Asal Sekolah</th>
            <td>{{ $asalSekolah }}</td>
        </tr>
        <tr>
            <th>Nama Orang Tua/Wali</th>
            <td>{{ $namaOrangTua }}</td>
        </tr>
        <tr>
            <th>Nomor HP/WhatsApp</th>
            <td>{{ $nomorHP }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ $email }}</td>
        </tr>
        <tr>
            <th>Jenjang Pendidikan</th>
            <td>{{ $jenjang }}</td>
        </tr>
        <tr>
            <th>Pesan Tambahan</th>
            <td>{{ $pesan ?? 'Tidak ada pesan tambahan' }}</td>
        </tr>
    </table>

    <p>Harap segera ditindaklanjuti. Terima kasih!</p>
</body>
</html>
