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
                Section::make('Profil Reseller')
                    ->description('Detail informasi akun dan kontak reseller')
                    ->icon('heroicon-o-user-circle')
                    ->columnSpanFull()
                    ->schema([

                        Grid::make(3)
                            ->schema([

                                // =========================
                                // FOTO PROFIL
                                // =========================
                                ImageEntry::make('foto')
                                    ->hiddenLabel()
                                    ->circular()
                                    ->extraImgAttributes([
                                        'class' => 'w-40 h-40 shadow-lg border-4 border-white object-cover mx-auto',
                                    ])
                                    ->getStateUsing(
                                        fn($record) => $record->foto_url
                                    )
                                    ->defaultImageUrl(
                                        fn($record) =>
                                        'https://ui-avatars.com/api/?background=random&name=' .
                                            urlencode($record->nama_lengkap)
                                    )
                                    ->columnSpan(1),

                                // =========================
                                // INFORMASI RESELLER
                                // =========================
                                Grid::make(2)
                                    ->schema([

                                        TextEntry::make('nama_lengkap')
                                            ->label('Nama Lengkap')
                                            ->weight('bold')
                                            ->size('lg')
                                            ->icon('heroicon-o-user')
                                            ->extraAttributes([
                                                'class' => 'bg-blue-50 border border-blue-100 rounded-xl p-4 shadow-sm',
                                            ]),

                                        TextEntry::make('prodi')
                                            ->label('Program Studi')
                                            ->badge()
                                            ->color('info')
                                            ->icon('heroicon-o-academic-cap')
                                            ->extraAttributes([
                                                'class' => 'bg-indigo-50 border border-indigo-100 rounded-xl p-4 shadow-sm',
                                            ]),

                                        TextEntry::make('whatsapp')
                                            ->label('Nomor WhatsApp')
                                            ->icon('heroicon-o-phone')
                                            ->copyable()
                                            ->placeholder('-')
                                            ->extraAttributes([
                                                'class' => 'bg-emerald-50 border border-emerald-100 rounded-xl p-4 shadow-sm',
                                            ]),

                                        TextEntry::make('instagram')
                                            ->label('Instagram')
                                            ->icon('heroicon-o-at-symbol')
                                            ->placeholder('-')
                                            ->extraAttributes([
                                                'class' => 'bg-pink-50 border border-pink-100 rounded-xl p-4 shadow-sm',
                                            ]),

                                        TextEntry::make('tiktok')
                                            ->label('TikTok')
                                            ->icon('heroicon-o-video-camera')
                                            ->placeholder('-')
                                            ->extraAttributes([
                                                'class' => 'bg-slate-50 border border-slate-200 rounded-xl p-4 shadow-sm',
                                            ]),

                                        TextEntry::make('created_at')
                                            ->label('Tanggal Bergabung')
                                            ->dateTime('d F Y')
                                            ->icon('heroicon-o-calendar')
                                            ->placeholder('-')
                                            ->extraAttributes([
                                                'class' => 'bg-amber-50 border border-amber-100 rounded-xl p-4 shadow-sm',
                                            ]),

                                        TextEntry::make('bio')
                                            ->label('Bio / Deskripsi Profil')
                                            ->markdown()
                                            ->placeholder('Belum ada bio yang ditambahkan.')
                                            ->columnSpanFull()
                                            ->extraAttributes([
                                                'class' => 'bg-violet-50 border border-violet-100 rounded-xl p-4 shadow-sm',
                                            ]),

                                    ])
                                    ->columnSpan(2),
                            ]),
                    ]),
            ]);
    }
}
