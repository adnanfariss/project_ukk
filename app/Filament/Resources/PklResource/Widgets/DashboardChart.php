<?php

namespace App\Filament\Resources\PklResource\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Siswa;
use App\Models\Guru;
use App\Models\Industri;

class DashboardChart extends ChartWidget
{
    protected static ?string $heading = 'Statistik Keanggotaan';
    protected static ?string $pollingInterval = null;
    protected static ?string $maxHeight = '300px';

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Jumlah',
                    'data' => [
                        Siswa::count(),
                        Guru::count(),
                        Industri::count()
                    ],
                    'backgroundColor' => ['#3B82F6', '#F59E0B', '#8B5CF6'],
                ]
            ],
            'labels' => ['Siswa', 'Guru', 'Industri'],
        ];
    }

    protected function getType(): string
    {
        return 'bar'; // pie, doughnut, line, etc
    }

    protected function getOptions(): array
    {
        return [
            'scales' => [
                'y' => [
                    'beginAtZero' => true
                ]
            ],
            'plugins' => [
                'legend' => [
                    'position' => 'top',
                ],
            ],
        ];
    }
}