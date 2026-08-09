<?php

namespace App\Filament\Resources\Restocks;

use App\Filament\Resources\Restocks\Pages\CreateRestock;
use App\Filament\Resources\Restocks\Pages\EditRestock;
use App\Filament\Resources\Restocks\Pages\ListRestocks;
use App\Filament\Resources\Restocks\Schemas\RestockForm;
use App\Filament\Resources\Restocks\Tables\RestocksTable;
use App\Models\Restock;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class RestockResource extends Resource
{
    protected static ?string $model = Restock::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Restock';

    public static function form(Schema $schema): Schema
    {
        return RestockForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return RestocksTable::configure($table);
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
            'index' => ListRestocks::route('/'),
            'create' => CreateRestock::route('/create'),
            'edit' => EditRestock::route('/{record}/edit'),
        ];
    }
}
