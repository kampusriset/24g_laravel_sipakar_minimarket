<?php

namespace App\Filament\Resources\RestockPredictions\Pages;

use App\Filament\Resources\RestockPredictions\RestockPredictionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListRestockPredictions extends ListRecords
{
    protected static string $resource = RestockPredictionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
