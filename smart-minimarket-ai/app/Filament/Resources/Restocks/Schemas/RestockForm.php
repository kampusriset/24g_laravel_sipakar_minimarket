<?php

namespace App\Filament\Resources\Restocks\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class RestockForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('product_id')
                    ->relationship('product', 'id')
                    ->required(),
                Select::make('supplier_id')
                    ->relationship('supplier', 'id'),
                TextInput::make('jumlah')
                    ->required()
                    ->numeric(),
                TextInput::make('harga_beli')
                    ->required()
                    ->numeric(),
                DatePicker::make('tanggal_restock')
                    ->required(),
                TextInput::make('nomor_restock')
                    ->required(),
                Textarea::make('catatan')
                    ->columnSpanFull(),
            ]);
    }
}
