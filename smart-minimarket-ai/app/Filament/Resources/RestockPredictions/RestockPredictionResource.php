<?php

namespace App\Filament\Resources\RestockPredictions;

use App\Filament\Resources\RestockPredictions\Pages\CreateRestockPrediction;
use App\Filament\Resources\RestockPredictions\Pages\EditRestockPrediction;
use App\Filament\Resources\RestockPredictions\Pages\ListRestockPredictions;
use App\Filament\Resources\RestockPredictions\Schemas\RestockPredictionForm;
use App\Filament\Resources\RestockPredictions\Tables\RestockPredictionsTable;
use App\Models\RestockPrediction;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class RestockPredictionResource extends Resource
{
    protected static ?string $model = RestockPrediction::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'nama_prediksirestok';

    public static function form(Schema $schema): Schema
    {
        return RestockPredictionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return RestockPredictionsTable::configure($table);
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
            'index' => ListRestockPredictions::route('/'),
            'create' => CreateRestockPrediction::route('/create'),
            'edit' => EditRestockPrediction::route('/{record}/edit'),
        ];
    }
}
