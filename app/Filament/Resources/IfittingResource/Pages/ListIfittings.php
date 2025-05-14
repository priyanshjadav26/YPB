<?php

namespace App\Filament\Resources\IfittingResource\Pages;

use App\Filament\Resources\IfittingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListIfittings extends ListRecords
{
    protected static string $resource = IfittingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->label('Add New Fitting'),
        ];
    }

   
}
