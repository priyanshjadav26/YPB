<?php

namespace App\Filament\Resources\HpackagingResource\Pages;

use App\Filament\Resources\HpackagingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHpackagings extends ListRecords
{
    protected static string $resource = HpackagingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->label('Add New Packaging'),
        ];
    }
}
