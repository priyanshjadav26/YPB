<?php

namespace App\Filament\Resources\ReadyproductResource\Pages;

use App\Filament\Resources\ReadyproductResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListReadyproducts extends ListRecords
{
    protected static string $resource = ReadyproductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
