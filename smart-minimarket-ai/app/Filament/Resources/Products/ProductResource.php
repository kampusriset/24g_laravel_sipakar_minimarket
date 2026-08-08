public static function table(Table $table): Table
{
    return $table
        ->columns([

            TextColumn::make('kode_produk')
                ->label('Kode')
                ->searchable()
                ->sortable()
                ->copyable()
                ->copyMessage('Kode produk disalin')
                ->copyMessageDuration(1500),

            TextColumn::make('nama_produk')
                ->label('Produk')
                ->searchable()
                ->sortable()
                ->weight('bold')
                ->limit(30),

            TextColumn::make('category.nama_kategori')
                ->label('Kategori')
                ->searchable()
                ->sortable()
                ->badge(),

            TextColumn::make('supplier.nama_supplier')
                ->label('Supplier')
                ->searchable()
                ->sortable()
                ->limit(20),

            TextColumn::make('harga_jual')
                ->label('Harga Jual')
                ->money('IDR')
                ->sortable(),

            TextColumn::make('stock')
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

            TextColumn::make('minimum_stock')
                ->label('Min. Stock')
                ->numeric()
                ->sortable(),

            TextColumn::make('rata_penjualan')
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