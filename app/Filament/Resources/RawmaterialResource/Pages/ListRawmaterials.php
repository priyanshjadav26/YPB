<?php

namespace App\Filament\Resources\RawmaterialResource\Pages;

use App\Filament\Resources\RawmaterialResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRawmaterials extends ListRecords
{
    protected static string $resource = RawmaterialResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
