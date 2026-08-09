<?php

namespace App\Filament\Resources\Products;

use App\Models\Product;
use BackedEnum;
use Filament\Forms;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use UnitEnum;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-cube';

    protected static ?string $navigationLabel = 'Products';

    protected static ?string $modelLabel = 'Produk';

    protected static ?string $pluralModelLabel = 'Produk';

    protected static string|UnitEnum|null $navigationGroup = 'Data Master';

    /*
    |--------------------------------------------------------------------------
    | FORM
    |--------------------------------------------------------------------------
    */

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([

                Section::make('Informasi Produk')
                    ->schema([

                        Forms\Components\TextInput::make('kode_produk')
                            ->label('Kode Produk')
                            ->disabled()
                            ->dehydrated()
                            ->unique(ignoreRecord: true),

                        Forms\Components\TextInput::make('nama_produk')
                            ->label('Nama Produk')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\Select::make('kategori_id')
                            ->label('Kategori')
                            ->relationship(
                                'category',
                                'nama_kategori'
                            )
                            ->searchable()
                            ->preload()
                            ->required(),

                        Forms\Components\Select::make('supplier_id')
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

                        Forms\Components\TextInput::make('harga_beli')
                            ->label('Harga Beli')
                            ->numeric()
                            ->prefix('Rp')
                            ->required()
                            ->minValue(0),

                        Forms\Components\TextInput::make('harga_jual')
                            ->label('Harga Jual')
                            ->numeric()
                            ->prefix('Rp')
                            ->required()
                            ->minValue(0),

                        Forms\Components\TextInput::make('stock')
                            ->label('Stock')
                            ->numeric()
                            ->minValue(0)
                            ->required(),

                        Forms\Components\TextInput::make('minimum_stock')
                            ->label('Minimum Stock')
                            ->numeric()
                            ->minValue(0)
                            ->required(),

                        Forms\Components\TextInput::make('rata_penjualan')
                            ->label('Rata-rata Penjualan')
                            ->numeric()
                            ->disabled()
                            ->dehydrated(false),

                    ])
                    ->columns(2),

                Section::make('Informasi Tambahan')
                    ->schema([

                        Forms\Components\FileUpload::make('gambar')
                            ->label('Gambar Produk')
                            ->image()
                            ->directory('products')
                            ->disk('public'),

                        Forms\Components\Textarea::make('deskripsi')
                            ->label('Deskripsi')
                            ->rows(4)
                            ->columnSpanFull(),

                    ])
                    ->columns(2),

            ]);
    }

    /*
    |--------------------------------------------------------------------------
    | TABLE
    |--------------------------------------------------------------------------
    */

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\TextColumn::make('kode_produk')
                    ->label('Kode')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->copyMessage('Kode produk disalin')
                    ->copyMessageDuration(1500),

                Tables\Columns\TextColumn::make('nama_produk')
                    ->label('Produk')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->limit(30),

                Tables\Columns\TextColumn::make('category.nama_kategori')
                    ->label('Kategori')
                    ->searchable()
                    ->sortable()
                    ->badge(),

                Tables\Columns\TextColumn::make('supplier.nama_supplier')
                    ->label('Supplier')
                    ->searchable()
                    ->sortable()
                    ->limit(20),

                Tables\Columns\TextColumn::make('harga_jual')
                    ->label('Harga Jual')
                    ->money('IDR')
                    ->sortable(),

                Tables\Columns\TextColumn::make('stock')
                    ->label('Stock')
                    ->numeric()
                    ->sortable()
                    ->badge()
                    ->color(
                        fn ($record) =>
                            $record->stock <= $record->minimum_stock
                                ? 'danger'
                                : 'success'
                    )
                    ->formatStateUsing(
                        fn ($state) => $state . ' pcs'
                    ),

                Tables\Columns\TextColumn::make('minimum_stock')
                    ->label('Min. Stock')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('rata_penjualan')
                    ->label('Rata-rata')
                    ->numeric()
                    ->sortable()
                    ->suffix(' pcs'),

            ])

            ->filters([

                Tables\Filters\SelectFilter::make('kategori_id')
                    ->label('Kategori')
                    ->relationship(
                        'category',
                        'nama_kategori'
                    )
                    ->searchable()
                    ->preload(),

                Tables\Filters\SelectFilter::make('supplier_id')
                    ->label('Supplier')
                    ->relationship(
                        'supplier',
                        'nama_supplier'
                    )
                    ->searchable()
                    ->preload(),

                Tables\Filters\Filter::make('stock_menipis')
                    ->label('Stock Menipis')
                    ->query(
                        fn ($query) =>
                            $query->whereColumn(
                                'stock',
                                '<=',
                                'minimum_stock'
                            )
                    ),

            ])

            ->recordActions([

                \Filament\Actions\EditAction::make()
                    ->label('Edit'),

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

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public static function getRelations(): array
    {
        return [];
    }

    /*
    |--------------------------------------------------------------------------
    | PAGES
    |--------------------------------------------------------------------------
    */

    public static function getPages(): array
{
    return [
        'index' => Pages\ListProducts::route('/'),
        'create' => Pages\CreateProduct::route('/create'),
        'edit' => Pages\EditProduct::route('/{record}/edit'),
    ];
}
}