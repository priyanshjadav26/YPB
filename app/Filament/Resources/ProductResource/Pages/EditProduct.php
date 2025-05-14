<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Models\Readyproduct;
use Illuminate\Support\Facades\Log;
class EditProduct extends EditRecord
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    protected function getRedirectUrl(): string
    {
        return url('/admin/products');
    }

    protected function afterSave(): void
{
    $record = $this->record;

    // Log the record for debugging
    Log::info('Updating or creating Readyproduct', [
        'product_id' => $record->id,
        'name' => $record->name,
        'price' => $record->price,
        'quantity' => $record->quantity,
        'quantity_type' => $record->quantity_type,
        'total' => $record->price * $record->quantity,
        'stock' => $record->stock,
        'stock_amount' => $record->stock_amount,
    ]);

    Readyproduct::updateOrCreate(
        ['product_id' => $record->id], // Condition to find the existing record
        [
            'name' => $record->name,
            'price' => $record->price,
            'quantity' => $record->quantity,
            'quantity_type' => $record->quantity_type,
            'total' => $record->price * $record->quantity,
            'stock' => $record->stock,
            'stock_amount' => $record->stock_amount,
        ]
    );
}

}
