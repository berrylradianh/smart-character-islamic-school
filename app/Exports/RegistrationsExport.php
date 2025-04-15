<?php

namespace App\Exports;

use App\Models\Registration;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RegistrationsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Registration::with('schoolLocation')->get()->map(function ($registration) {
            return [
                'No' => $registration->id,
                'Jenjang' => strtoupper($registration->user->level->name),
                'Nama Anak' => $registration->user->name,
                'Nama Orang Tua' => $registration->user->nama_orang_tua,
                'No HP' => $registration->user->no_hp_orang_tua,
                'Jadwal Tes' => $registration->jadwal_tes ? \Carbon\Carbon::parse($registration->jadwal_tes)->format('d F Y H:i') : 'Belum Ditentukan',
                'Lokasi Tes' => $registration->schoolLocation ? $registration->schoolLocation->nama_lokasi : 'Belum Ditentukan',
                'Status' => ucfirst($registration->status),
            ];
        });
    }

    public function headings(): array
    {
        return [
            'No',
            'Jenjang',
            'Nama Anak',
            'Nama Orang Tua',
            'No HP',
            'Jadwal Tes',
            'Lokasi Tes',
            'Status',
        ];
    }
}
