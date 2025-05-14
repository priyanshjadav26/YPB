<?php

namespace App\Filament\Resources\IfittingResource\Pages;

use App\Filament\Resources\IfittingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditIfitting extends EditRecord
{
    protected static string $resource = IfittingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return url('/admin/ifittings');
    }
}
