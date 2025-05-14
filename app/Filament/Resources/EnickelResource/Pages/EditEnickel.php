<?php

namespace App\Filament\Resources\EnickelResource\Pages;

use App\Filament\Resources\EnickelResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEnickel extends EditRecord
{
    protected static string $resource = EnickelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    protected function getRedirectUrl(): string
    {
        return url('/admin/enickels');
    }
}
