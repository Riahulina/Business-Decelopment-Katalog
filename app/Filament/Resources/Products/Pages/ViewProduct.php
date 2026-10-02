<?php

namespace App\Filament\Resources\Products\Pages;

use App\Filament\Resources\Products\ProductResource;
use Filament\Actions\Action;
use Filament\Resources\Pages\ViewRecord;

class ViewProduct extends ViewRecord
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('toggleFeatured')
                ->label(fn() => $this->record->is_featured ? 'Cabut Produk Unggulan' : 'Jadikan Produk Unggulan')
                ->color(fn() => $this->record->is_featured ? 'gray' : 'primary')
                ->action(function () {
                    $this->record->update(['is_featured' => ! $this->record->is_featured]);
                    $this->refreshFormData(['is_featured']);
                }),

            Action::make('toggleNew')
                ->label(fn() => $this->record->is_new ? 'Cabut Produk Baru' : 'Jadikan Produk Baru')
                ->color(fn() => $this->record->is_new ? 'gray' : 'primary')
                ->action(function () {
                    $this->record->update(['is_new' => ! $this->record->is_new]);
                    $this->refreshFormData(['is_new']);
                }),
        ];
    }
}
