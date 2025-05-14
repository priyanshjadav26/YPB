<?php

namespace App\Filament\Resources\PendingstockResource\Pages;

use App\Filament\Resources\PendingstockResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPendingstock extends EditRecord
{
    protected static string $resource = PendingstockResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return url('/admin/pendingstocks');
    }
}
