<?php

namespace App\Filament\Resources\PurchaseResource\Pages;

use App\Filament\Resources\PurchaseResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

use App\Models\RawMaterial;

class CreatePurchase extends CreateRecord
{
    protected static string $resource = PurchaseResource::class;

    protected function afterCreate(): void
    {
        $record = $this->record;
        RawMaterial::create([
            'category' => $record->category,
            'name' => $record->name,
            'purchase_party' => $record->purchase_party,
            'quantity' => $record->quantity,
            'price' => $record->price,
            'total' => $record->price * $record->quantity,
        ]);
        
    }

    protected function getRedirectUrl(): string
    {
        return url('/admin/purchases');
    }
}
