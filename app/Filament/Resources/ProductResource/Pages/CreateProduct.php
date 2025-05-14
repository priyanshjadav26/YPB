<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use App\Models\Readyproduct;
use Illuminate\Support\Facades\Log;

class CreateProduct extends CreateRecord
{
    protected static string $resource = ProductResource::class;

    // protected function afterCreate(): void
    // {
    //     $record = $this->record;

    //     Readyproduct::create([
    //         'product_id' => $record->id, 
    //         'name' => $record->name,
    //         'price' => $record->price,
    //         'quantity' => $record->quantity,
    //         'quantity_type' => $record->quantity_type,
    //         'total' => $record->price * $record->quantity,
    //         'stock' => $record->stock,
    //         'stock_amount' => $record->stock_amount,
    //     ]);
    // }
    protected function afterCreate(): void
    {
        $record = $this->record;
        
        // Log the record for debugging
        Log::info('Creating Readyproduct', [
            'product_id' => $record->id,
            'name' => $record->name,
            'price' => $record->price,
            'quantity' => $record->quantity,
            'quantity_type' => $record->quantity_type,
            'total' => $record->price * $record->quantity,
            'stock' => $record->stock,
            'stock_amount' => $record->stock_amount,
        ]);

        Readyproduct::create([
            'product_id' => $record->id, // Ensure product_id is correctly set
            'name' => $record->name,
            'price' => $record->price,
            'quantity' => $record->quantity,
            'quantity_type' => $record->quantity_type,
            'total' => $record->price * $record->quantity,
            'stock' => $record->stock,
            'stock_amount' => $record->stock_amount,
        ]);
    }

    protected function getRedirectUrl(): string
    {
        return url('/admin/products');
    }
}
