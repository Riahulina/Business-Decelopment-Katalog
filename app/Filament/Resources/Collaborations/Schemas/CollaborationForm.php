<?php

namespace App\Filament\Resources\Collaborations\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class CollaborationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama Kolaborasi')
                    ->required()
                    ->maxLength(255),

                Textarea::make('description')
                    ->label('Deskripsi')
                    ->rows(4),

                FileUpload::make('logo')
                    ->label('Logo')
                    ->image()
                    ->disk('public')
                    ->directory('collaborations'),

                TextInput::make('link')
                    ->label('Link (opsional)')
                    ->maxLength(255),

                Toggle::make('is_active')
                    ->label('Tampilkan di halaman publik')
                    ->default(true),
            ]);
    }
}
