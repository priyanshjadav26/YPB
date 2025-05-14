<?php

namespace App\Filament\Resources\BlasiyaResource\Pages;

use App\Filament\Resources\BlasiyaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListBlasiyas extends ListRecords
{
    protected static string $resource = BlasiyaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->label('Add New Lasiya'),

        ];
    }
}
