<?php

namespace App\Filament\Resources\Resellers\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ResellerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('user_id')
                    ->label('Akun Pengguna')
                    ->relationship('user', 'name')
                    ->disabled(),

                TextInput::make('nama_lengkap')
                    ->label('Nama Lengkap')
                    ->required()
                    ->maxLength(255),

                TextInput::make('prodi')
                    ->label('Program Studi')
                    ->maxLength(255),

                TextInput::make('whatsapp')
                    ->label('Nomor WhatsApp')
                    ->tel()
                    ->maxLength(20),

                FileUpload::make('foto')
                    ->label('Foto Profil')
                    ->image()
                    ->directory('resellers')
                    ->avatar(),

                TextInput::make('instagram')
                    ->label('Instagram')
                    ->maxLength(100),

                TextInput::make('tiktok')
                    ->label('TikTok')
                    ->maxLength(100),

                Textarea::make('bio')
                    ->label('Bio')
                    ->rows(3)
                    ->columnSpanFull(),
            ]);
    }
}
