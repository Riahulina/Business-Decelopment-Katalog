<?php

namespace App\Filament\Resources\Resellers\Pages;

use App\Filament\Resources\Resellers\ResellerResource;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Pages\ViewRecord;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ViewReseller extends ViewRecord
{
    protected static string $resource = ResellerResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }

    public function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([

                /*
                |--------------------------------------------------------------------------
                | PROFIL UTAMA
                |--------------------------------------------------------------------------
                */

                Section::make('Profil Reseller')
                    ->description('Informasi dasar mahasiswa yang terdaftar sebagai reseller.')
                    ->icon('heroicon-o-user-circle')
                    ->extraAttributes([
                        'class' => 'reseller-profile-section',
                    ])
                    ->columnSpanFull()
                    ->schema([

                        Grid::make(3)
                            ->schema([

                                /*
                                | FOTO
                                */

                                ImageEntry::make('foto')
                                    ->hiddenLabel()
                                    ->circular()
                                    ->getStateUsing(
                                        fn($record) => $record->foto_url
                                    )
                                    ->defaultImageUrl(
                                        fn($record) =>
                                        'https://ui-avatars.com/api/?background=random&name=' .
                                            urlencode($record->nama_lengkap)
                                    )
                                    ->extraImgAttributes([
                                        'class' => 'reseller-profile-photo',
                                    ])
                                    ->columnSpan(1),

                                /*
                                | DATA UTAMA
                                */

                                Grid::make(2)
                                    ->schema([

                                        TextEntry::make('nama_lengkap')
                                            ->label('Nama Lengkap')
                                            ->icon('heroicon-o-user')
                                            ->weight('bold')
                                            ->size('lg')
                                            ->extraAttributes([
                                                'class' => 'reseller-info-card reseller-blue',
                                            ]),

                                        TextEntry::make('prodi')
                                            ->label('Program Studi')
                                            ->icon('heroicon-o-academic-cap')
                                            ->badge()
                                            ->color('info')
                                            ->extraAttributes([
                                                'class' => 'reseller-info-card reseller-indigo',
                                            ]),

                                        TextEntry::make('whatsapp')
                                            ->label('Nomor WhatsApp')
                                            ->icon('heroicon-o-phone')
                                            ->copyable()
                                            ->placeholder('Belum ditambahkan')
                                            ->extraAttributes([
                                                'class' => 'reseller-info-card reseller-green',
                                            ]),

                                        TextEntry::make('created_at')
                                            ->label('Tanggal Bergabung')
                                            ->icon('heroicon-o-calendar')
                                            ->dateTime('d F Y')
                                            ->placeholder('-')
                                            ->extraAttributes([
                                                'class' => 'reseller-info-card reseller-orange',
                                            ]),

                                        TextEntry::make('bio')
                                            ->label('Bio / Deskripsi Profil')
                                            ->icon('heroicon-o-document-text')
                                            ->placeholder('Belum ada bio yang ditambahkan.')
                                            ->columnSpanFull()
                                            ->extraAttributes([
                                                'class' => 'reseller-info-card reseller-purple',
                                            ]),

                                    ])
                                    ->columnSpan(2),

                            ]),
                    ]),

                /*
                |--------------------------------------------------------------------------
                | INFORMASI KONTAK
                |--------------------------------------------------------------------------
                */

                Section::make('Informasi Kontak')
                    ->description('Informasi yang dapat digunakan untuk menghubungi reseller.')
                    ->icon('heroicon-o-identification')
                    ->extraAttributes([
                        'class' => 'reseller-section reseller-contact-section',
                    ])
                    ->columnSpanFull()
                    ->schema([

                        Grid::make(3)
                            ->schema([

                                TextEntry::make('user.email')
                                    ->label('Email Akun')
                                    ->icon('heroicon-o-envelope')
                                    ->copyable()
                                    ->placeholder('Belum tersedia')
                                    ->extraAttributes([
                                        'class' => 'contact-item',
                                    ]),

                                TextEntry::make('whatsapp')
                                    ->label('Nomor WhatsApp')
                                    ->icon('heroicon-o-phone')
                                    ->copyable()
                                    ->placeholder('Belum tersedia')
                                    ->extraAttributes([
                                        'class' => 'contact-item contact-wa',
                                    ]),

                                TextEntry::make('created_at')
                                    ->label('Tanggal Bergabung')
                                    ->icon('heroicon-o-calendar')
                                    ->dateTime('d F Y')
                                    ->placeholder('-')
                                    ->extraAttributes([
                                        'class' => 'contact-item',
                                    ]),

                            ]),
                    ]),

                /*
                |--------------------------------------------------------------------------
                | MEDIA SOSIAL
                |--------------------------------------------------------------------------
                */

                Section::make('Media Sosial')
                    ->description('Akun media sosial yang terhubung dengan profil reseller.')
                    ->icon('heroicon-o-share')
                    ->extraAttributes([
                        'class' => 'reseller-section reseller-social-section',
                    ])
                    ->columnSpanFull()
                    ->schema([

                        Grid::make(2)
                            ->schema([

                                TextEntry::make('instagram')
                                    ->label('Instagram')
                                    ->icon('heroicon-o-at-symbol')
                                    ->placeholder('Belum ditambahkan')
                                    ->copyable()
                                    ->extraAttributes([
                                        'class' => 'social-item instagram-item',
                                    ]),

                                TextEntry::make('tiktok')
                                    ->label('TikTok')
                                    ->icon('heroicon-o-video-camera')
                                    ->placeholder('Belum ditambahkan')
                                    ->copyable()
                                    ->extraAttributes([
                                        'class' => 'social-item tiktok-item',
                                    ]),

                            ]),
                    ]),

            ]);
    }
}
