<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SiswaResource\Pages;
use App\Filament\Resources\SiswaResource\RelationManagers;
use App\Models\Siswa;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SiswaResource extends Resource
{
    protected static ?string $model = Siswa::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nama')
                    ->required()
                    ->maxLength(50),
                Forms\Components\TextInput::make('nis')
                    ->required()
                    ->maxLength(5)
                    ->unique(ignoreRecord: true),
                Forms\Components\Select::make('gender')
                    ->required()
                    ->options([
                        'L' => 'Laki-laki',
                        'P' => 'Perempuan',
                    ]),
                Forms\Components\Textarea::make('alamat')
                    ->required()
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('kontak')
                    ->required()
                    ->maxLength(16)
                    ->unique(ignoreRecord: true)
                    ->placeholder('+6281234567890')
                    ->prefix('+62')
                    ->afterStateHydrated(function (Forms\Components\TextInput $component, $state) {
                        if ($state && str_starts_with($state, '0')) {
                            $component->state('+62' . substr($state, 1));
                        } elseif ($state && !str_starts_with($state, '+62')) {
                            $component->state('+62' . $state);
                        }
                    })
                    ->dehydrateStateUsing(fn ($state) => $state ? 
                    (str_starts_with($state, '0') ? '+62' . substr($state, 1) : 
                    (str_starts_with($state, '+62') ? $state : '+62' . $state)) 
                    : $state)
                    ->rule('regex:/^(\+62|0)\d{9,15}$/')
                    ->validationMessages([
                        'regex' => 'Format nomor harus diawali 0 atau +62 diikuti 9-15 digit angka',
                    ]),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(30)
                    ->unique(ignoreRecord: true),
                Forms\Components\Toggle::make('status_lapor_pkl')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->searchable(),
                Tables\Columns\TextColumn::make('nis')
                    ->searchable(),
                Tables\Columns\TextColumn::make('gender')
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'L' => 'Laki-laki',
                        'P' => 'Perempuan',
                        default => $state,
                    }),
                Tables\Columns\TextColumn::make('kontak')
                    ->formatStateUsing(fn (string $state): string => 
                        $state && str_starts_with($state, '0') ? '+62' . substr($state, 1) : 
                        ($state && !str_starts_with($state, '+62') ? '+62' . $state : $state)
                    )
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\IconColumn::make('status_lapor_pkl')
                    ->boolean(),
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
                Tables\Actions\DeleteAction::make()
                    ->visible(fn ($record) => !$record->status_lapor_pkl),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->checkIfRecordIsSelectableUsing(fn ($record) => false);
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
            'index' => Pages\ListSiswas::route('/'),
            'create' => Pages\CreateSiswa::route('/create'),
            'edit' => Pages\EditSiswa::route('/{record}/edit'),
        ];
    }
}