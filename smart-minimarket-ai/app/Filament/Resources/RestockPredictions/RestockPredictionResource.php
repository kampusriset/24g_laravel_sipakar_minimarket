<?php

namespace App\Filament\Resources\RestockPredictions;

use App\Filament\Resources\RestockPredictions\Pages\ListRestockPredictions;
use App\Filament\Resources\RestockPredictions\Tables\RestockPredictionsTable;
use App\Models\RestockPrediction;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use UnitEnum;

class RestockPredictionResource extends Resource
{
     protected static bool $shouldRegisterNavigation = false;
    protected static ?string $model = RestockPrediction::class;


    protected static ?string $navigationLabel = 'AI Restock Prediction';

    protected static string|UnitEnum|null $navigationGroup = 'Artificial Intelligence';


    // hilangkan tombol create
    public static function canCreate(): bool
    {
        return false;
    }


    // tidak ada form
    public static function form(Schema $schema): Schema
    {
        return $schema;
    }


    public static function table(Table $table): Table
    {
        return RestockPredictionsTable::configure($table);
    }


    public static function getPages(): array
    {
        return [
            'index' => ListRestockPredictions::route('/'),
        ];
    }
}