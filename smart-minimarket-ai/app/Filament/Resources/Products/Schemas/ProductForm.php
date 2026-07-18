<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('kode_produk')
                    ->required()
                    ->maxLength(50),

                TextInput::make('nama_produk')
                    ->required()
                    ->maxLength(255),

                Select::make('kategori_id')
                    ->relationship('category', 'nama_kategori')
                    ->searchable()
                    ->preload()
                    ->required(),

                Select::make('supplier_id')
                    ->relationship('supplier', 'nama_supplier')
                    ->searchable()
                    ->preload()
                    ->required(),

                TextInput::make('harga_beli')
                    ->numeric()
                    ->prefix('Rp')
                    ->required(),

                TextInput::make('harga_jual')
                    ->numeric()
                    ->prefix('Rp')
                    ->required(),

                TextInput::make('stock')
                    ->numeric()
                    ->required(),

                TextInput::make('minimum_stock')
                    ->numeric()
                    ->required(),

                TextInput::make('lead_time_supplier')
                    ->numeric(),

                FileUpload::make('gambar')
                    ->image()
                    ->directory('produk'),

                Textarea::make('deskripsi')
                    ->rows(3),
            ]);
    }
}