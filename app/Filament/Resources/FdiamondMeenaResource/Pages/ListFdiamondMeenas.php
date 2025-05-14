<?php

namespace App\Filament\Resources\FdiamondMeenaResource\Pages;

use App\Filament\Resources\FdiamondMeenaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFdiamondMeenas extends ListRecords
{
    protected static string $resource = FdiamondMeenaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->label('Add New Dimond'),
        ];
    }
}
