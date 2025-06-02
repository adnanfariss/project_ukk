<?php

namespace App\Filament\Resources\PklResource\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Siswa; // Sesuaikan dengan model Siswa Anda
use App\Models\Pkl;   // Sesuaikan dengan model PKL Anda

class DashboardChart extends ChartWidget
{
    protected static ?string $heading = 'Status Laporan PKL Siswa';
    
    protected static ?string $description = 'Persentase siswa yang sudah melaporkan PKL';

    protected function getData(): array
    {
        // Hitung total siswa
        $totalSiswa = Siswa::count();
        
        // Hitung siswa yang sudah lapor PKL (asumsi ada relasi atau field status)
        // Opsi 1: Jika ada relasi hasOne/hasMany antara Siswa dan PKL
        $siswaLaporPkl = Siswa::where('status_lapor_pkl')->count();
        
        // Opsi 2: Jika ada field status di tabel siswa
        // $siswaLaporPkl = Siswa::where('status_pkl', 'sudah_lapor')->count();
        
        // Opsi 3: Jika menggunakan tabel PKL dengan foreign key siswa_id
        // $siswaLaporPkl = Pkl::distinct('siswa_id')->count();
        
        $siswaBelumLapor = $totalSiswa - $siswaLaporPkl;
        
        // Hitung persentase
        $persentaseSudahLapor = $totalSiswa > 0 ? round(($siswaLaporPkl / $totalSiswa) * 100, 1) : 0;
        $persentaseBelumLapor = $totalSiswa > 0 ? round(($siswaBelumLapor / $totalSiswa) * 100, 1) : 0;

        return [
            'datasets' => [
                [
                    'label' => 'Status PKL',
                    'data' => [$siswaLaporPkl, $siswaBelumLapor],
                    'backgroundColor' => [
                        '#10B981', // Hijau untuk sudah lapor
                        '#EF4444', // Merah untuk belum lapor
                    ],
                    'borderColor' => [
                        '#059669',
                        '#DC2626',
                    ],
                    'borderWidth' => 2,
                ],
            ],
            'labels' => [
                "Sudah Lapor ({$persentaseSudahLapor}%)",
                "Belum Lapor ({$persentaseBelumLapor}%)"
            ],
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }
    
    protected function getOptions(): array
    {
        return [
            'responsive' => true,
            'maintainAspectRatio' => false,
            'plugins' => [
                'legend' => [
                    'position' => 'bottom',
                    'labels' => [
                        'usePointStyle' => true,
                        'padding' => 20,
                    ],
                ],
                'tooltip' => [
                    'callbacks' => [
                        'label' => 'function(context) {
                            const label = context.label || "";
                            const value = context.parsed;
                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                            const percentage = ((value / total) * 100).toFixed(1);
                            return label + ": " + value + " siswa (" + percentage + "%)";
                        }'
                    ]
                ]
            ],
        ];
    }
}