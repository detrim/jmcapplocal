<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $table = 'pegawai';

    protected $fillable = [
        'foto', 'nip', 'nama', 'email', 'no_hp', 'tempat_lahir',
        'alamat_kecamatan', 'alamat_kabupaten', 'alamat_provinsi', 'alamat_lengkap',
        'tanggal_lahir', 'status_kawin', 'jumlah_anak', 'tanggal_masuk',
        'jabatan', 'departemen', 'usia', 'pendidikan', 'status','jenis_kelamin','status_pegawai'
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'tanggal_masuk' => 'date',
        'pendidikan' => 'array',
        'status' => 'boolean'
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'employee_id', 'nip');
    }

}
