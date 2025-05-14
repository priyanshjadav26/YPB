<?php

namespace App\Filament\Resources\PendingstockResource\Pages;

use App\Filament\Resources\PendingstockResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPendingstocks extends ListRecords
{
    protected static string $resource = PendingstockResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
