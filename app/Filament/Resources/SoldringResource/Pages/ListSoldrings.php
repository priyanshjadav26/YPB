<?php

namespace App\Filament\Resources\SoldringResource\Pages;

use App\Filament\Resources\SoldringResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSoldrings extends ListRecords
{
    protected static string $resource = SoldringResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
