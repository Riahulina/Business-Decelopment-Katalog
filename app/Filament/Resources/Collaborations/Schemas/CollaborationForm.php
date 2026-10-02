<?php

namespace App\Filament\Resources\Collaborations\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CollaborationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                /*
                |--------------------------------------------------------------------------
                | INFORMASI KOLABORASI
                |--------------------------------------------------------------------------
                */

                Section::make('Informasi Kolaborasi')
                    ->description('Informasi utama mengenai kolaborasi.')
                    ->icon('heroicon-o-user-group')
                    ->iconColor('primary')
                    ->extraAttributes([
                        'class' => 'collaboration-section',
                    ])
                    ->columnSpanFull()
                    ->schema([

                        Grid::make(2)
                            ->schema([

                                TextInput::make('name')
                                    ->label('Nama Kolaborasi')
                                    ->placeholder('Contoh: HMPS Manajemen Informatika')
                                    ->required()
                                    ->maxLength(255)
                                    ->extraAttributes([
                                        'class' => 'collaboration-field',
                                    ]),

                                Toggle::make('is_active')
                                    ->label('Tampilkan di halaman publik')
                                    ->helperText('Aktifkan jika ingin ditampilkan.')
                                    ->default(true)
                                    ->inline(false)
                                    ->extraAttributes([
                                        'class' => 'collaboration-toggle',
                                    ]),

                                Textarea::make('description')
                                    ->label('Deskripsi')
                                    ->placeholder('Tuliskan deskripsi kolaborasi...')
                                    ->rows(4)
                                    ->extraAttributes([
                                        'class' => 'collaboration-field',
                                    ])
                                    ->columnSpanFull(),

                            ]),

                    ]),

                /*
                |--------------------------------------------------------------------------
                | MEDIA & TAUTAN
                |--------------------------------------------------------------------------
                */

                Section::make('Media & Tautan')
                    ->description('Logo dan tautan yang berkaitan dengan kolaborasi.')
                    ->icon('heroicon-o-photo')
                    ->iconColor('info')
                    ->extraAttributes([
                        'class' => 'collaboration-section',
                    ])
                    ->columnSpanFull()
                    ->schema([

                        Grid::make(2)
                            ->schema([

                                FileUpload::make('logo')
                                    ->label('Logo Kolaborasi')
                                    ->helperText('Format JPG, JPEG, atau PNG.')
                                    ->image()
                                    ->imageEditor()
                                    ->disk('public')
                                    ->directory('collaborations')
                                    ->extraAttributes([
                                        'class' => 'collaboration-upload',
                                    ]),

                                TextInput::make('link')
                                    ->label('Link Kolaborasi')
                                    ->placeholder('https://...')
                                    ->helperText('Opsional. Instagram, website, atau halaman terkait.')
                                    ->url()
                                    ->maxLength(255)
                                    ->extraAttributes([
                                        'class' => 'collaboration-field',
                                    ]),

                            ]),

                    ]),

            ]);
    }
}
