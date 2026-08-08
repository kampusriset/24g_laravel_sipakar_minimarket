<?php

namespace App\Filament\Resources;

use App\Filament\Resources\Products\Pages;
use App\Models\Product;
use BackedEnum;
use Filament\Actions\EditAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-cube';

    protected static ?string $navigationLabel = 'Products';

    protected static ?string $modelLabel = 'Produk';

    protected static ?string $pluralModelLabel = 'Produk';

    protected static string|\UnitEnum|null $navigationGroup = 'Data Master';


    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('Informasi Produk')
                    ->schema([

                        TextInput::make('kode_produk')
                            ->label('Kode Produk')
                            ->disabled(),

                        TextInput::make('nama_produk')
                            ->label('Nama Produk')
                            ->required()
                            ->maxLength(255),

                        Select::make('kategori_id')
                            ->label('Kategori')
                            ->relationship(
                                'category',
                                'nama_kategori'
                            )
                            ->searchable()
                            ->preload()
                            ->required(),

                        Select::make('supplier_id')
                            ->label('Supplier')
                            ->relationship(
                                'supplier',
                                'nama_supplier'
                            )
                            ->searchable()
                            ->preload()
                            ->required(),

                    ])
                    ->columns(2),


                Section::make('Harga dan Stock')
                    ->schema([

                        TextInput::make('harga_beli')
                            ->label('Harga Beli')
                            ->numeric()
                            ->prefix('Rp')
                            ->required(),

                        TextInput::make('harga_jual')
                            ->label('Harga Jual')
                            ->numeric()
                            ->prefix('Rp')
                            ->required(),

                        TextInput::make('stock')
                            ->label('Stock')
                            ->numeric()
                            ->required(),

                        TextInput::make('minimum_stock')
                            ->label('Minimum Stock')
                            ->numeric()
                            ->required(),

                        TextInput::make('rata_penjualan')
                            ->label('Rata-rata Penjualan')
                            ->numeric()
                            ->disabled(),

                    ])
                    ->columns(2),


                Section::make('Informasi Tambahan')
                    ->schema([

                        FileUpload::make('gambar')
                            ->label('Gambar Produk')
                            ->image()
                            ->directory('products')
                            ->disk('public'),

                        Textarea::make('deskripsi')
                            ->label('Deskripsi')
                            ->rows(4)
                            ->columnSpanFull(),

                    ])
                    ->columns(2),

            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('kode_produk')
                    ->label('Kode')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('nama_produk')
                    ->label('Produk')
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
                    ->label('Harga Jual')
                    ->money('IDR')
                    ->sortable(),

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
                    }),

                TextColumn::make('minimum_stock')
                    ->label('Minimum')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('rata_penjualan')
                    ->label('Rata-rata')
                    ->numeric()
                    ->sortable(),

            ])

            ->filters([

                SelectFilter::make('kategori_id')
                    ->label('Kategori')
                    ->relationship(
                        'category',
                        'nama_kategori'
                    ),

                SelectFilter::make('supplier_id')
                    ->label('Supplier')
                    ->relationship(
                        'supplier',
                        'nama_supplier'
                    ),

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

            ->recordActions([
                EditAction::make(),
            ])

            ->defaultSort(
                'nama_produk',
                'asc'
            )

            ->striped();
    }


    public static function getRelations(): array
    {
        return [];
    }


    public static function getPages(): array
    {
        return [

            'index' => Pages\ListProducts::route('/'),

            'edit' => Pages\EditProduct::route('/{record}/edit'),

        ];
    }
}