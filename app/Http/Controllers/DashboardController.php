<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pkl;
use App\Models\Siswa;
use App\Models\Industri;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Total siswa
        $totalSiswa = Siswa::count();
        
        // Siswa yang sudah lapor PKL
        $siswaLaporPkl = Pkl::distinct('siswa_id')->count();
        $persenSiswaLapor = $totalSiswa > 0 ? round(($siswaLaporPkl / $totalSiswa) * 100, 1) : 0;
        
        // Siswa yang sedang dalam proses PKL (PKL yang belum selesai)
        $siswaProsesPkl = Pkl::where('selesai', '>', Carbon::now())->distinct('siswa_id')->count();
        $persenSiswaProses = $totalSiswa > 0 ? round(($siswaProsesPkl / $totalSiswa) * 100, 1) : 0;
        
        // Total industri yang tergabung
        $totalIndustri = Industri::count();
        
        // Industri yang aktif (memiliki siswa PKL)
        $industriAktif = Industri::whereHas('pkls')->count();
        
        // Data untuk pie chart
        $siswaSelesaiPkl = Pkl::where('selesai', '<=', Carbon::now())->distinct('siswa_id')->count();
        $siswaBelumPkl = $totalSiswa - $siswaLaporPkl;
        
        $chartData = [
            'labels' => ['Sudah Lapor PKL', 'Sedang PKL', 'Belum PKL'],
            'data' => [$siswaSelesaiPkl, $siswaProsesPkl, $siswaBelumPkl],
            'colors' => ['#10B981', '#F59E0B', '#EF4444']
        ];
        
        return view('dashboard', compact(
            'totalSiswa',
            'siswaLaporPkl',
            'persenSiswaLapor',
            'siswaProsesPkl',
            'persenSiswaProses',
            'totalIndustri',
            'industriAktif',
            'chartData'
        ));
    }
}