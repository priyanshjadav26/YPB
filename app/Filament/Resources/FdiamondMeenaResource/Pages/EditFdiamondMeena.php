<?php

namespace App\Filament\Resources\FdiamondMeenaResource\Pages;

use App\Filament\Resources\FdiamondMeenaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditFdiamondMeena extends EditRecord
{
    protected static string $resource = FdiamondMeenaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    protected function getRedirectUrl(): string
    {
        return url('/admin/fdiamond-meenas');
    }
}
