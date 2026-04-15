<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use app\Models\Role;
use App\Models\Pegawai;


class DashboardController extends Controller
{
    public function index()
    {
        if(auth()->user()->isManagerHRD()){
        // Total pegawai aktif
          $total_pegawai = Pegawai::where('status', 1)->count();
            // Pegawai kontrak
            $pegawai_kontrak = Pegawai::where('status_pegawai', 'kontrak')->count();
            // Pegawai tetap
            $pegawai_tetap = Pegawai::where('status_pegawai', 'tetap')->count();
            // Pegawai magang
            $pegawai_magang = Pegawai::where('jabatan', 'magang')->count();
        // Jenis kelamin
            $laki_laki = Pegawai::where('jenis_kelamin', 'L')->count();
            $perempuan = Pegawai::where('jenis_kelamin', 'P')->count();

            // 5 pegawai terbaru
           $pegawai_baru = Pegawai::where('status', 1)
            ->where('status_pegawai', 'kontrak')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

            return view('dashboard', compact(
                'total_pegawai',
                'pegawai_kontrak',
                'pegawai_tetap',
                'pegawai_magang',
                'laki_laki',
                'perempuan',
                'pegawai_baru'
            ));
        }else{
            return view('dashboard');
        }

    }
}
