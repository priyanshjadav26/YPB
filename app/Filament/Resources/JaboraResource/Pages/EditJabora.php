<?php

namespace App\Filament\Resources\JaboraResource\Pages;

use App\Filament\Resources\JaboraResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditJabora extends EditRecord
{
    protected static string $resource = JaboraResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    protected function getRedirectUrl(): string
    {
        return url('/admin/jaboras');
    }
}

