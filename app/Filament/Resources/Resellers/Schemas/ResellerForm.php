<?php

namespace App\Filament\Resources\Resellers\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ResellerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama_lengkap')
                    ->label('Nama Lengkap')
                    ->disabled(),

                TextInput::make('prodi')
                    ->label('Program Studi')
                    ->disabled(),

                TextInput::make('whatsapp')
                    ->label('Nomor WhatsApp')
                    ->disabled(),

                TextInput::make('instagram')
                    ->label('Instagram')
                    ->disabled(),

                TextInput::make('tiktok')
                    ->label('TikTok')
                    ->disabled(),

                FileUpload::make('foto')
                    ->label('Foto Profil')
                    ->avatar()
                    ->disabled()
                    ->dehydrated(false)
                    ->formatStateUsing(fn($record) => $record?->foto),

                Textarea::make('bio')
                    ->label('Bio')
                    ->disabled()
                    ->columnSpanFull(),
            ]);
    }
}
