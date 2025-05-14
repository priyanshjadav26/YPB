<?php

namespace App\Filament\Resources\CsoldringResource\Pages;

use App\Filament\Resources\CsoldringResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCsoldrings extends ListRecords
{
    protected static string $resource = CsoldringResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->label('Add New soldring'),
        ];
    }
}
