<?php

namespace App\Filament\Resources\HpackagingResource\Pages;

use App\Filament\Resources\HpackagingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHpackaging extends EditRecord
{
    protected static string $resource = HpackagingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    protected function getRedirectUrl(): string
    {
        return url('/admin/hpackagings');
    }
}
