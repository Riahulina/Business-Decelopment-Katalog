<?php

namespace App\Filament\Resources\Resellers\Tables;

use Filament\Actions\ViewAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ResellersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('foto')
                    ->label('')
                    ->circular()
                    ->getStateUsing(fn($record) => $record->foto_url)
                    ->defaultImageUrl(fn($record) => 'https://ui-avatars.com/api/?background=random&name=' . urlencode($record->nama_lengkap)),

                TextColumn::make('nama_lengkap')
                    ->label('Nama Lengkap')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('prodi')
                    ->label('Prodi')
                    ->searchable(),

                TextColumn::make('whatsapp')
                    ->label('WhatsApp')
                    ->searchable(),

                TextColumn::make('instagram')
                    ->label('Instagram')
                    ->searchable(),

                TextColumn::make('products_count')
                    ->label('Produk')
                    ->counts('products')
                    ->badge()
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Bergabung')
                    ->dateTime('d M Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->defaultSort('nama_lengkap')
            ->actions([
                ViewAction::make(),
            ]);
    }
}
