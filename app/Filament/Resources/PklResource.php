<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PklResource\Pages;
use App\Filament\Resources\PklResource\RelationManagers;
use App\Models\Pkl;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PklResource extends Resource
{
    protected static ?string $model = Pkl::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-check';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('siswa_id')
                    ->relationship('siswa', 'nama') // Menampilkan nama siswa
                    ->required()
                    ->searchable()
                    ->preload(),
                    
                Forms\Components\Select::make('industri_id')
                    ->relationship('industri', 'nama') // Menampilkan nama industri
                    ->required()
                    ->searchable()
                    ->preload(),
                    
                Forms\Components\Select::make('guru_id')
                    ->relationship('guru', 'nama') // Menampilkan nama guru
                    ->required()
                    ->searchable()
                    ->preload(),
                    
                Forms\Components\TextInput::make('bidang_usaha')
                    ->required()
                    ->maxLength(255),
                    
                Forms\Components\DatePicker::make('mulai')
                    ->required()
                    ->live()
                    ->afterStateUpdated(function ($state, Forms\Set $set, $get) {
                        if ($state && $get('selesai')) {
                            $mulai = \Carbon\Carbon::parse($state);
                            $selesai = \Carbon\Carbon::parse($get('selesai'));
                            $set('lama_hari', $mulai->diffInDays($selesai));
                        }
                    }),
                    
                Forms\Components\DatePicker::make('selesai')
                    ->required()
                    ->live()
                    ->afterStateUpdated(function ($state, Forms\Set $set, $get) {
                        if ($state && $get('mulai')) {
                            $mulai = \Carbon\Carbon::parse($get('mulai'));
                            $selesai = \Carbon\Carbon::parse($state);
                            $set('lama_hari', $mulai->diffInDays($selesai));
                        }
                    }),
                    
                Forms\Components\TextInput::make('lama_hari')
                    ->numeric()
                    ->readOnly(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('siswa.nama') // Menampilkan nama siswa
                    ->searchable()
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('industri.nama') // Menampilkan nama industri
                    ->searchable()
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('guru.nama') // Menampilkan nama guru
                    ->searchable()
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('bidang_usaha')
                    ->searchable()
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('mulai')
                    ->date()
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('selesai')
                    ->date()
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('lama_hari')
                    ->label('Durasi (Hari)')
                    ->sortable(),
                    
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                    
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPkls::route('/'),
            'create' => Pages\CreatePkl::route('/create'),
            'edit' => Pages\EditPkl::route('/{record}/edit'),
        ];
    }
}