<?php
namespace App\Exports;

use App\Models\Pegawai;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PegawaiExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Pegawai::all()->map(function ($p) {

            $diff = \Carbon\Carbon::parse($p->tanggal_masuk)->diff(now());

            return [
                'NIP' => $p->nip,
                'Nama' => $p->nama,
                'Email' => $p->email,
                'No HP' => $p->no_hp,
                'Jabatan' => $p->jabatan,
                'Departemen' => $p->departemen,
                'Tanggal Masuk' => $p->tanggal_masuk,
                'Masa Kerja' => $diff->y . ' tahun ' . $diff->m . ' bulan',
                'Status' => $p->status == 1 ? 'Aktif' : 'Tidak Aktif',
            ];
        });
    }

    public function headings(): array
    {
        return [
            'NIP',
            'Nama',
            'Email',
            'No HP',
            'Jabatan',
            'Departemen',
            'Tanggal Masuk',
            'Masa Kerja',
            'Status',
        ];
    }
}
