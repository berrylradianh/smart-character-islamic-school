<?php

namespace App\Exports;

use App\Models\Registration;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class RegistrationsExport implements FromCollection, WithHeadings, WithStyles
{
    public function collection()
    {
        return Registration::with('schoolLocation')->get()->map(function ($registration) {
            $statusMap = [
                'waiting' => 'Proses',
                'decline' => 'Tidak Lolos',
                'approve' => 'Lolos',
                'accepted' => 'Diterima',
                'not_accepted' => 'Tidak Diterima',
            ];

            $status = isset($statusMap[$registration->status]) ? $statusMap[$registration->status] : 'Proses';

            return [
                'No' => $registration->id,
                'Jenjang' => strtoupper($registration->user->level->name),
                'Nama Anak' => $registration->user->name,
                'Nama Ayah Kandung/Wali' => $registration->user->nama_ayah ?? $registration->user->nama_ayah_wali ?? 'Tidak Tersedia',
                'Nama Ibu Kandung/Wali' => $registration->user->nama_ibu ?? $registration->user->nama_ibu_wali ?? 'Tidak Tersedia',
                'No HP Orang Tua/Wali' => $registration->user->telepon_ortu ?? $registration->user->telepon_wali ?? 'Tidak Tersedia',
                'Jadwal Tes' => $registration->jadwal_tes ? \Carbon\Carbon::parse($registration->jadwal_tes)->format('d F Y H:i') : 'Belum Ditentukan',
                'Lokasi Tes' => $registration->schoolLocation ? $registration->schoolLocation->nama_lokasi : 'Belum Ditentukan',
                'Status' => $status,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'No',
            'Jenjang',
            'Nama Anak',
            'Nama Ayah Kandung/Wali',
            'Nama Ibu Kandung/Wali',
            'No HP Orang Tua/Wali',
            'Jadwal Tes',
            'Lokasi Tes',
            'Status',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->setAutoFilter('I1:I1');

        return [
            1 => ['font' => ['bold' => true]],
        ];
    }
}
