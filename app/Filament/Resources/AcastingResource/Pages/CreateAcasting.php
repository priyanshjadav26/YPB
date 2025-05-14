<?php

namespace App\Filament\Resources\AcastingResource\Pages;

use App\Filament\Resources\AcastingResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

use App\Models\AcastingReceive;

class CreateAcasting extends CreateRecord
{
    protected static string $resource = AcastingResource::class;

    protected function getRedirectUrl(): string
    {
        return url('/admin/acastings');
    }


    protected function afterCreate(): void
    {
        $record = $this->record;

        // Retrieve the receives data from the request
        $receivesData = $this->data['receives'];

        // Store each receive record with the acasting_id
        foreach ($receivesData as $receive) {
            AcastingReceive::create([
                'acasting_id' => $record->id,
                'receive_date' => $receive['receive_date'],
                'receive_weight' => $receive['receive_weight'],
                'rate' => $receive['rate'],
                'total' => $receive['total'],
            ]);
        }
    }

    public function getHeading(): string
    {
        return 'Create Casting';
    }
    
    
}