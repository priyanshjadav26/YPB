<?php

namespace App\Filament\Resources\ReadyproductResource\Pages;

use App\Filament\Resources\ReadyproductResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditReadyproduct extends EditRecord
{
    protected static string $resource = ReadyproductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    protected function getRedirectUrl(): string
    {
        return url('/admin/readyproducts');
    }
}
