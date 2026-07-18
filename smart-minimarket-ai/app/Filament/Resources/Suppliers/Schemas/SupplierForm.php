<?php

namespace App\Filament\Resources\Suppliers\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class SupplierForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama_Supplier')
                    ->label('Nama Supplier')
                    ->required()
                    ->maxLength(100),

                TextInput::make('telepon')
                    ->label('Telepon')
                    ->required()
                    ->tel(),
                Textarea::make('alamat')
                    ->label('Alamat')   
            ]);
    }
}