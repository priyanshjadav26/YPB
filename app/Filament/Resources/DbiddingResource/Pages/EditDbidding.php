<?php

namespace App\Filament\Resources\DbiddingResource\Pages;

use App\Filament\Resources\DbiddingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDbidding extends EditRecord
{
    protected static string $resource = DbiddingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    protected function getRedirectUrl(): string
    {
        return url('/admin/dbiddings');
    }
}
