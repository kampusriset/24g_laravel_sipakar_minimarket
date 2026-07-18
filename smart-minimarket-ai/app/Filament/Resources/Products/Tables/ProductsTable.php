<?php

namespace App\Filament\Resources\Products\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('gambar')
                    ->label('Gambar')
                    ->disk('public')
                    ->circular(),

                TextColumn::make('kode_produk')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('nama_produk')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('category.nama_kategori')
                    ->label('Kategori')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('supplier.nama_supplier')
                    ->label('Supplier')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('harga_jual')
                    ->label('Harga')
                    ->money('IDR')
                    ->sortable(),

                TextColumn::make('stock')
                    ->badge()
                    ->color(fn ($state) => match (true) {
                        $state <= 5 => 'danger',
                        $state <= 10 => 'warning',
                        default => 'success',
                    })
                    ->sortable(),

                TextColumn::make('minimum_stock')
                    ->label('Min Stock'),

                TextColumn::make('created_at')
                    ->dateTime('d M Y')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('kategori_id')
                    ->relationship('category', 'nama_kategori')
                    ->label('Kategori'),

                SelectFilter::make('supplier_id')
                    ->relationship('supplier', 'nama_supplier')
                    ->label('Supplier'),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}