<?php

namespace App\Filament\Resources\CsoldringResource\Pages;

use App\Filament\Resources\CsoldringResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCsoldring extends EditRecord
{
    protected static string $resource = CsoldringResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    protected function getRedirectUrl(): string
    {
        return url('/admin/csoldrings');
    }
}
