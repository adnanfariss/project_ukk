<?php

namespace App\Filament\Resources\SiswaResource\Pages;

use App\Filament\Resources\SiswaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSiswa extends EditRecord
{
    protected static string $resource = SiswaResource::class;

    protected function getHeaderActions(): array
    {
    return [
                Actions\DeleteAction::make()
                    ->visible(function () {
                        // Opsi 1: Jika ada field status_lapor_pkl di tabel siswa
                        return !$this->record->status_lapor_pkl;
                        
                        // Opsi 2: Jika menggunakan relasi PKL
                        // return !$this->record->pkl()->exists();
                        
                        // Opsi 3: Jika menggunakan method custom di model
                        // return !$this->record->hasReportedPkl();
                    }),
            ];
    }
}
