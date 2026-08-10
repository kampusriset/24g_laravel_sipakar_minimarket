<?php

namespace App\Filament\Resources\RestockPredictions\Tables;

use Filament\Tables;
use Filament\Tables\Table;

class RestockPredictionsTable
{

    public static function configure(Table $table): Table
    {
        return $table

            ->columns([

                Tables\Columns\TextColumn::make('ranking')
                    ->label('Ranking')
                    ->rowIndex(),


                Tables\Columns\TextColumn::make('product.nama_produk')
                    ->label('Produk')
                    ->searchable(),


                Tables\Columns\TextColumn::make('product.kategori.nama_kategori')
                    ->label('Kategori'),


                Tables\Columns\TextColumn::make('stock')
                    ->label('Stock')
                    ->badge()
                    ->color('danger'),


                Tables\Columns\TextColumn::make('minimum_stock')
                    ->label('Minimum'),


                Tables\Columns\TextColumn::make('rata_penjualan')
                    ->label('Rata Penjualan/Minggu'),


                Tables\Columns\TextColumn::make('score_ai')
                    ->label('Score AI')
                    ->badge()
                    ->color(function ($state) {

                        if ($state >= 80) {
                            return 'danger';
                        }

                        if ($state >= 50) {
                            return 'warning';
                        }

                        return 'success';

                    }),

            ])

            ->defaultSort('score_ai','desc')

            ->actions([]);
    }

}