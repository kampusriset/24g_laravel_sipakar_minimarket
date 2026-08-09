<?php

namespace App\Filament\Resources\Products\Pages;

use App\Filament\Resources\Products\ProductResource;
use App\Models\Product;
use Filament\Resources\Pages\CreateRecord;

class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['kode_produk'] = $this->generateKodeProduk();

        return $data;
    }

    private function generateKodeProduk(): string
    {
        $lastProduct = Product::query()
            ->where('kode_produk', 'like', 'PRD-%')
            ->orderByDesc('id')
            ->first();

        if (! $lastProduct) {
            return 'PRD-0001';
        }

        $lastNumber = (int) str_replace(
            'PRD-',
            '',
            $lastProduct->kode_produk
        );

        return 'PRD-' . str_pad(
            $lastNumber + 1,
            4,
            '0',
            STR_PAD_LEFT
        );
    }
}