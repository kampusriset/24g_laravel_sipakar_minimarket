<?php

namespace App\Filament\Resources\StockHistories\Pages;

use App\Filament\Resources\StockHistories\StockHistoryResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListStockHistories extends ListRecords
{
    protected static string $resource = StockHistoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
