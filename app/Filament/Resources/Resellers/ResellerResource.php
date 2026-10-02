<?php

namespace App\Filament\Resources\Resellers;

// Hapus import EditReseller jika tidak digunakan lagi
use App\Filament\Resources\Resellers\Pages\ListResellers;
use App\Filament\Resources\Resellers\Pages\ViewReseller;
use App\Filament\Resources\Resellers\Schemas\ResellerForm;
use App\Filament\Resources\Resellers\Tables\ResellersTable;
use App\Models\Reseller;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ResellerResource extends Resource
{
    protected static ?string $model = Reseller::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUsers;

    protected static ?string $recordTitleAttribute = 'nama_lengkap';

    protected static ?string $navigationLabel = 'Reseller';
    protected static ?string $modelLabel = 'Reseller';
    protected static ?string $pluralModelLabel = 'Reseller';

    public static function form(Schema $schema): Schema
    {
        return ResellerForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ResellersTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListResellers::route('/'),
            'view'  => ViewReseller::route('/{record}'),
            // Route 'edit' dihapus agar halaman edit tidak bisa diakses
        ];
    }
}
