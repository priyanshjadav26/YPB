<?php

namespace App\Filament\Resources\GvibratingResource\Pages;

use App\Filament\Resources\GvibratingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditGvibrating extends EditRecord
{
    protected static string $resource = GvibratingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    protected function getRedirectUrl(): string
    {
        return url('/admin/gvibratings');
    }
}
