<?php

namespace App\Filament\Resources\Products\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use filament\Tables\Filters\Filter;
use filament\Tables\Filters\SelectFilter;
use illuminate\Database\Eloquent\Builder;


class ProductsTable
{
    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                // KODE PRODUK
                TextColumn::make('kode_produk')
                    ->label('Kode')
                    ->searchable()
                    ->sortable()
                    ->copyable(),

                // NAMA PRODUK
                TextColumn::make('nama_produk')
                    ->label('Produk')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                // KATEGORI
                TextColumn::make('category.nama_kategori')
                    ->label('Kategori')
                    ->badge()
                    ->searchable()
                    ->sortable(),

                // SUPPLIER
                TextColumn::make('supplier.nama_supplier')
                    ->label('Supplier')
                    ->searchable()
                    ->sortable(),

                // HARGA JUAL
                TextColumn::make('harga_jual')
                    ->label('Harga Jual')
                    ->money('IDR')
                    ->sortable(),

                // STOCK
                TextColumn::make('stock')
                    ->label('Stock')
                    ->numeric()
                    ->sortable()
                    ->badge()
                    ->color(function ($record) {

                        if ($record->stock <= $record->minimum_stock) {
                            return 'danger';
                        }

                        return 'success';
                    })
                    ->formatStateUsing(function ($state, $record) {

                        if ($record->stock <= $record->minimum_stock) {
                            return $state . ' • Menipis';
                        }

                        return $state . ' • Aman';
                    }),

                // MINIMUM STOCK
                TextColumn::make('minimum_stock')
                    ->label('Minimum')
                    ->numeric()
                    ->sortable(),

                // RATA-RATA PENJUALAN
                TextColumn::make('rata_penjualan')
                    ->label('Rata-rata Penjualan')
                    ->numeric()
                    ->sortable(),

            ])

            ->filters([

                // FILTER KATEGORI
                SelectFilter::make('kategori_id')
                    ->label('Kategori')
                    ->relationship(
                        'category',
                        'nama_kategori'
                    ),

                // FILTER SUPPLIER
                SelectFilter::make('supplier_id')
                    ->label('Supplier')
                    ->relationship(
                        'supplier',
                        'nama_supplier'
                    ),

                // FILTER STOCK MENIPIS
                Filter::make('stock_menipis')
                    ->label('Stock Menipis')
                    ->query(function (Builder $query) {

                        return $query->whereColumn(
                            'stock',
                            '<=',
                            'minimum_stock'
                        );
                    }),

            ])

            ->headerActions([
                \Filament\Actions\CreateAction::make()
                    ->label('Tambah Produk')
                    ->icon('heroicon-o-plus'),
            ])

            ->recordActions([
                EditAction::make()
                    ->label('Edit')
                    ->icon('heroicon-o-pencil'),
            ])

            ->defaultSort(
                'nama_produk',
                'asc'
            )

            ->striped()

            ->paginated([
                10,
                25,
                50,
            ]);
    }
}
