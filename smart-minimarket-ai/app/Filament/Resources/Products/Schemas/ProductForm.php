<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('kode_produk')
                    ->required(),
                TextInput::make('nama_produk')
                    ->required(),
                TextInput::make('kategori_id')
                    ->required()
                    ->numeric(),
                TextInput::make('supplier_id')
                    ->required()
                    ->numeric(),
                TextInput::make('harga_beli')
                    ->required()
                    ->numeric(),
                TextInput::make('harga_jual')
                    ->required()
                    ->numeric(),
                TextInput::make('stock')
                    ->required()
                    ->numeric(),
                TextInput::make('minimum_stock')
                    ->required()
                    ->numeric(),
                TextInput::make('rata_penjualan')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('gambar'),
                Textarea::make('deskripsi')
                    ->columnSpanFull(),
            ]);
    }
}
