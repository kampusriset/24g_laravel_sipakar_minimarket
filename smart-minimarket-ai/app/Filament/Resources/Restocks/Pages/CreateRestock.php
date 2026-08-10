<?php

namespace App\Filament\Resources\Restocks\Pages;

use App\Filament\Resources\Restocks\RestockResource;
use Filament\Resources\Pages\CreateRecord;
use App\Models\StockHistory;

class CreateRestock extends CreateRecord
{
    protected static string $resource = RestockResource::class;


    protected function afterCreate(): void
    {
          dd($this->record);
        $restock = $this->record;


        StockHistory::create([

            'product_id' => $restock->product_id,

            'jenis' => 'restock',

            'jumlah' => $restock->jumlah,

            'stock_sebelum' => 
                $restock->product->stock - $restock->jumlah,

            'stock_sesudah' => 
                $restock->product->stock,

            'keterangan' =>
                'Restock dari admin'

        ]);
    }
}