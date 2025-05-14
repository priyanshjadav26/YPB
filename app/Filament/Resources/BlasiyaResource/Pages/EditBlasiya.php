<?php

namespace App\Filament\Resources\BlasiyaResource\Pages;

use App\Filament\Resources\BlasiyaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBlasiya extends EditRecord
{
    protected static string $resource = BlasiyaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    protected function getRedirectUrl(): string
    {
        return url('/admin/blasiyas');
    }
}
