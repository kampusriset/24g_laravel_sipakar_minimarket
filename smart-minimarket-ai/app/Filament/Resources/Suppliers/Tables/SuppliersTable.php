<?php

namespace App\Filament\Resources\Suppliers\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SuppliersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nama_supplier')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('telepon')
                    ->label('Telepon')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('alamat')
                    ->limit(40),

                TextColumn::make('products_count')
                    ->counts('products')
                    ->label('Jumlah Produk'),
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