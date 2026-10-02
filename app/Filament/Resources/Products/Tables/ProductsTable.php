<?php

namespace App\Filament\Resources\Products\Tables;

use Filament\Actions\Action;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([

                // =====================================================
                // NAMA PRODUK
                // =====================================================
                TextColumn::make('name')
                    ->label('Nama Produk')
                    ->searchable()
                    ->sortable(),

                // =====================================================
                // RESELLER
                // =====================================================
                TextColumn::make('reseller.nama_lengkap')
                    ->label('Reseller')
                    ->searchable(),

                // =====================================================
                // KATEGORI
                // =====================================================
                TextColumn::make('category.name')
                    ->label('Kategori')
                    ->searchable(),

                // =====================================================
                // HARGA
                // =====================================================
                TextColumn::make('price')
                    ->label('Harga')
                    ->money('idr')
                    ->sortable(),

                // =====================================================
                // STATUS
                // =====================================================
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'pending'  => 'warning',
                        'approved' => 'success',
                        'rejected' => 'danger',
                        default    => 'gray',
                    })
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'pending'  => 'Menunggu',
                        'approved' => 'Disetujui',
                        'rejected' => 'Ditolak',
                        default    => $state,
                    }),

                // =====================================================
                // WHATSAPP RESELLER
                // =====================================================
                TextColumn::make('reseller.whatsapp')
                    ->label('WhatsApp')
                    ->formatStateUsing(fn($state) => $state ? 'Hubungi WA' : '-')
                    ->url(function ($record) {

                        $whatsapp = preg_replace(
                            '/[^0-9]/',
                            '',
                            $record->reseller?->whatsapp ?? ''
                        );

                        if (!$whatsapp) {
                            return null;
                        }

                        $message =
                            "Halo {$record->reseller->nama_lengkap} 👋\n\n" .
                            "Saya Admin Business Development.\n" .
                            "Terkait produk *{$record->name}* yang kamu ajukan di BD Katalog.\n\n";

                        if ($record->status === 'approved') {

                            $message .=
                                "Produk kamu sudah *disetujui* dan telah dapat " .
                                "ditampilkan di katalog BD. 🎉\n\n";
                        } elseif ($record->status === 'rejected') {

                            $message .=
                                "Terkait pengajuan produk kamu, statusnya saat ini *ditolak*.\n\n";

                            if ($record->rejection_reason) {
                                $message .=
                                    "Alasan penolakan:\n" .
                                    $record->rejection_reason .
                                    "\n\n";
                            }
                        } else {

                            $message .=
                                "Pengajuan produk kamu masih dalam proses " .
                                "pemeriksaan admin.\n\n";
                        }

                        $message .= "Terima kasih.";

                        return 'https://wa.me/' .
                            $whatsapp .
                            '?text=' .
                            urlencode($message);
                    }, shouldOpenInNewTab: true)
                    ->color('success')
                    ->icon('heroicon-o-chat-bubble-left-right')
                    ->weight('bold'),

                // =====================================================
                // UNGGULAN
                // =====================================================
                ToggleColumn::make('is_featured')
                    ->label('Unggulan')
                    ->afterStateUpdated(function ($record, $state) {

                        Notification::make()
                            ->title(
                                $state
                                    ? 'Produk diaktifkan sebagai unggulan'
                                    : 'Produk dihapus dari unggulan'
                            )
                            ->body(
                                $state
                                    ? "\"{$record->name}\" sekarang tampil sebagai produk unggulan."
                                    : "\"{$record->name}\" tidak lagi ditampilkan sebagai produk unggulan."
                            )
                            ->success()
                            ->send();
                    }),

                // =====================================================
                // PRODUK BARU
                // =====================================================
                ToggleColumn::make('is_new')
                    ->label('Baru')
                    ->afterStateUpdated(function ($record, $state) {

                        Notification::make()
                            ->title(
                                $state
                                    ? 'Produk ditandai sebagai produk baru'
                                    : 'Tanda produk baru dinonaktifkan'
                            )
                            ->body(
                                $state
                                    ? "\"{$record->name}\" sekarang tampil sebagai produk baru."
                                    : "\"{$record->name}\" tidak lagi ditampilkan sebagai produk baru."
                            )
                            ->success()
                            ->send();
                    }),

                // =====================================================
                // TANGGAL PENGAJUAN
                // =====================================================
                TextColumn::make('created_at')
                    ->label('Diajukan')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])

            // =========================================================
            // FILTER
            // =========================================================
            ->filters([
                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'pending'  => 'Menunggu',
                        'approved' => 'Disetujui',
                        'rejected' => 'Ditolak',
                    ]),
            ])

            ->defaultSort('created_at', 'desc')

            // =========================================================
            // AKSI PER PRODUK
            // =========================================================
            ->recordActions([

                // =====================================================
                // SETUJUI
                // =====================================================
                Action::make('approve')
                    ->label('Setujui')
                    ->icon('heroicon-o-check')
                    ->color('success')
                    ->visible(fn($record) => $record->status === 'pending')
                    ->requiresConfirmation()
                    ->modalHeading('Setujui Produk')
                    ->modalDescription(
                        'Produk ini akan ditampilkan di katalog publik setelah disetujui.'
                    )
                    ->action(function ($record) {

                        // ---------------------------------------------
                        // UBAH STATUS PRODUK
                        // ---------------------------------------------
                        $record->update([
                            'status' => 'approved',
                            'rejection_reason' => null,
                        ]);

                        // ---------------------------------------------
                        // AMBIL DATA RESELLER
                        // ---------------------------------------------
                        $record->load('reseller');

                        $whatsappUrl = null;

                        if ($record->reseller?->whatsapp) {

                            $whatsapp = preg_replace(
                                '/[^0-9]/',
                                '',
                                $record->reseller->whatsapp
                            );

                            $message =
                                "Halo {$record->reseller->nama_lengkap} 👋\n\n" .
                                "Produk kamu telah disetujui oleh Admin BD Katalog.\n\n" .
                                "📦 *Produk:* {$record->name}\n" .
                                "📌 *Status:* Disetujui\n\n" .
                                "Produk kamu sekarang sudah dapat ditampilkan " .
                                "di katalog BD.\n\n" .
                                "Terima kasih sudah berpartisipasi di BD Katalog 🙌";

                            $whatsappUrl =
                                'https://wa.me/' .
                                $whatsapp .
                                '?text=' .
                                urlencode($message);
                        }

                        // ---------------------------------------------
                        // NOTIFICATION BERHASIL
                        // ---------------------------------------------
                        $notification = Notification::make()
                            ->title('Produk berhasil disetujui')
                            ->body(
                                "\"{$record->name}\" sekarang sudah tampil di katalog publik."
                            )
                            ->success();

                        // ---------------------------------------------
                        // TOMBOL WHATSAPP RESELLER
                        // ---------------------------------------------
                        if ($whatsappUrl) {

                            $notification->actions([
                                Action::make('whatsapp')
                                    ->label('Hubungi Reseller')
                                    ->button()
                                    ->url(
                                        $whatsappUrl,
                                        shouldOpenInNewTab: true
                                    ),
                            ]);
                        }

                        $notification->send();
                    }),

                // =====================================================
                // TOLAK
                // =====================================================
                Action::make('reject')
                    ->label('Tolak')
                    ->icon('heroicon-o-x-mark')
                    ->color('danger')
                    ->visible(fn($record) => $record->status === 'pending')
                    ->schema([
                        Textarea::make('rejection_reason')
                            ->label('Alasan Penolakan')
                            ->required()
                            ->rows(3)
                            ->placeholder(
                                'Jelaskan alasan produk ditolak...'
                            ),
                    ])
                    ->action(function ($record, array $data) {

                        $record->update([
                            'status' => 'rejected',
                            'rejection_reason' => $data['rejection_reason'],
                        ]);

                        Notification::make()
                            ->title('Produk berhasil ditolak')
                            ->body(
                                "\"{$record->name}\" telah ditolak dan alasan penolakan telah disimpan."
                            )
                            ->warning()
                            ->send();
                    }),

                // =====================================================
                // LIHAT DETAIL
                // =====================================================
                ViewAction::make(),
            ]);
    }
}
