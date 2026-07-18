<?php

namespace App\Filament\Resources\RestockPredictions\Pages;

use App\Filament\Resources\RestockPredictions\RestockPredictionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditRestockPrediction extends EditRecord
{
    protected static string $resource = RestockPredictionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
