<?php

namespace App\Filament\Resources\Restocks;

use App\Filament\Resources\Restocks\Pages;
use App\Models\Product;
use App\Models\Restock;
use App\Models\Supplier;
use BackedEnum;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use UnitEnum;

class RestockResource extends Resource
{
    protected static ?string $model = Restock::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-arrow-path';

    protected static string|UnitEnum|null $navigationGroup = 'Admin';

    protected static ?string $navigationLabel = 'Restock Produk';

    protected static ?string $modelLabel = 'Restock';

    protected static ?string $pluralModelLabel = 'Restock Produk';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([

                Select::make('product_id')
                    ->label('Produk')
                    ->relationship(
                        'product',
                        'nama_produk'
                    )
                    ->searchable()
                    ->preload()
                    ->live()
                    ->afterStateUpdated(function ($state, callable $set) {
                        if (!$state) {
                            $set('harga_beli', null);

                            return;
                        }

                        $product = Product::find($state);

                        $set(
                            'harga_beli',
                            $product?->harga_beli
                        );
                    })
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

                TextInput::make('jumlah')
                    ->label('Jumlah Restock')
                    ->numeric()
                    ->minValue(1)
                    ->required(),

                TextInput::make('harga_beli')
                    ->label('Harga Beli')
                    ->numeric()
                    ->prefix('Rp')
                    ->disabled()
                    ->dehydrated()
                    ->required()
                    ->afterStateHydrated(function ($component, $record) {
                        if ($record?->product) {
                            $component->state(
                                $record->product->harga_beli
                            );
                        }
                    }),

                DatePicker::make('tanggal_restock')
                    ->label('Tanggal Restock')
                    ->default(now())
                    ->required(),

                TextInput::make('nomor_restock')
                    ->label('Nomor Restock')
                    ->default(fn () => 'RST-' . now()->format('YmdHis'))
                    ->required()
                    ->unique(ignoreRecord: true),

                Textarea::make('keterangan')
                    ->label('Keterangan')
                    ->rows(3)
                    ->columnSpanFull(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('nomor_restock')
                    ->label('No. Restock')
                    ->searchable()
                    ->sortable(),

                \Filament\Tables\Columns\TextColumn::make('product.nama_produk')
                    ->label('Produk')
                    ->searchable()
                    ->sortable(),

                \Filament\Tables\Columns\TextColumn::make('supplier.nama_supplier')
                    ->label('Supplier')
                    ->searchable()
                    ->sortable(),

                \Filament\Tables\Columns\TextColumn::make('jumlah')
                    ->label('Jumlah')
                    ->numeric()
                    ->sortable()
                    ->suffix(' pcs'),

                \Filament\Tables\Columns\TextColumn::make('harga_beli')
                    ->label('Harga Beli')
                    ->money('IDR')
                    ->sortable(),

                \Filament\Tables\Columns\TextColumn::make('tanggal_restock')
                    ->label('Tanggal')
                    ->date('d M Y')
                    ->sortable(),

                \Filament\Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y H:i')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])

            ->filters([
                \Filament\Tables\Filters\SelectFilter::make('product_id')
                    ->label('Produk')
                    ->relationship(
                        'product',
                        'nama_produk'
                    )
                    ->searchable()
                    ->preload(),

                \Filament\Tables\Filters\SelectFilter::make('supplier_id')
                    ->label('Supplier')
                    ->relationship(
                        'supplier',
                        'nama_supplier'
                    )
                    ->searchable()
                    ->preload(),
            ])

            ->recordActions([
                \Filament\Actions\EditAction::make(),
            ])

            ->toolbarActions([
                \Filament\Actions\BulkActionGroup::make([
                    \Filament\Actions\DeleteBulkAction::make(),
                ]),
            ])

            ->defaultSort(
                'tanggal_restock',
                'desc'
            );
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRestocks::route('/'),
            'create' => Pages\CreateRestock::route('/create'),
            'edit' => Pages\EditRestock::route('/{record}/edit'),
        ];
    }
}