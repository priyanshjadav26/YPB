<?php

namespace App\Filament\Resources\EnickelResource\Pages;

use App\Filament\Resources\EnickelResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEnickels extends ListRecords
{
    protected static string $resource = EnickelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->label('Add New Nickel'),
        ];
    }
}
