<?php

namespace App\Filament\Resources\DbiddingResource\Pages;

use App\Filament\Resources\DbiddingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDbiddings extends ListRecords
{
    protected static string $resource = DbiddingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->label('Add New Bidding'),
        ];
    }
}
