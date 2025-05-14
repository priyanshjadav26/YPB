<?php

namespace App\Filament\Resources\SoldringResource\Pages;

use App\Filament\Resources\SoldringResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSoldring extends EditRecord
{
    protected static string $resource = SoldringResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
