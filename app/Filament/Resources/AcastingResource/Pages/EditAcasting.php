<?php
namespace App\Filament\Resources\AcastingResource\Pages;

use App\Filament\Resources\AcastingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Models\AcastingReceive;

class EditAcasting extends EditRecord
{
    protected static string $resource = AcastingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Remove the receives data from the main data array
        $receivesData = $data['receives'];
        unset($data['receives']);

        // Store the receives data in the state
        $this->receiveData = $receivesData;

        return $data;
    }

    protected function afterSave(): void
    {
        $record = $this->record;

        // Clear existing receives data
        AcastingReceive::where('acasting_id', $record->id)->delete();

        // Store each receive record with the acasting_id
        foreach ($this->receiveData as $receive) {
            AcastingReceive::create([
                'acasting_id' => $record->id,
                'receive_date' => $receive['receive_date'],
                'receive_weight' => $receive['receive_weight'],
                'rate' => $receive['rate'],
                // 'total' => $receive['total'],
                'total' => ($receive['receive_weight'] ?? 0) * ($receive['rate'] ?? 0),
            ]);
        }
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['receives'] = $this->record->receives->toArray();
        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return url('/admin/acastings');
    }

    
}