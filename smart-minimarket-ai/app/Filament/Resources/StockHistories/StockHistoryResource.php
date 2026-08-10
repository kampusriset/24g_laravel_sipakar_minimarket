<?php

namespace App\Filament\Resources\StockHistories;

use App\Filament\Resources\StockHistories\Pages\CreateStockHistory;
use App\Filament\Resources\StockHistories\Pages\EditStockHistory;
use App\Filament\Resources\StockHistories\Pages\ListStockHistories;
use App\Filament\Resources\StockHistories\Schemas\StockHistoryForm;
use App\Filament\Resources\StockHistories\Tables\StockHistoriesTable;
use App\Models\StockHistory;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class StockHistoryResource extends Resource
{
    protected static bool $shouldRegisterNavigation = false;
    protected static ?string $model = StockHistory::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'nama_riwayatstok';

    public static function form(Schema $schema): Schema
    {
        return StockHistoryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return StockHistoriesTable::configure($table);
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
            'index' => ListStockHistories::route('/'),
            'create' => CreateStockHistory::route('/create'),
            'edit' => EditStockHistory::route('/{record}/edit'),
        ];
    }
}
