<?php

namespace App\Filament\Resources\Products\RelationManagers;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class HighlightsRelationManager extends RelationManager
{
    protected static string $relationship = 'highlights';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Judul Keunggulan')
                    ->required()
                    ->maxLength(255),

                Textarea::make('description')
                    ->label('Deskripsi')
                    ->rows(3)
                    ->columnSpanFull(),

                Select::make('icon')
                    ->label('Icon')
                    ->options([
                        'sparkles' => '✨ Sparkles',
                        'leaf' => '🌿 Leaf',
                        'heart' => '❤️ Heart',
                        'star' => '⭐ Star',
                        'shield-check' => '🛡️ Shield Check',
                        'clock' => '⏱️ Clock',
                        'package' => '📦 Package',
                        'truck' => '🚚 Truck',
                        'wrench' => '🛠️ Wrench',
                        'circle-check' => '✓ Circle Check',
                    ])
                    ->searchable()
                    ->required(),

                TextInput::make('sort_order')
                    ->label('Urutan')
                    ->numeric()
                    ->default(0)
                    ->required()
                    ->helperText('0 = pertama, 1 = kedua, dan seterusnya.'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('title')
            ->columns([
                TextColumn::make('title')
                    ->label('Keunggulan')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('icon')
                    ->label('Icon'),

                TextColumn::make('sort_order')
                    ->label('Urutan')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Ditambahkan')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('sort_order')
            ->headerActions([
                CreateAction::make()
                    ->label('Tambah Keunggulan'),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
