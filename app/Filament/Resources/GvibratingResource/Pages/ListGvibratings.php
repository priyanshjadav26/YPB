<?php

namespace App\Filament\Resources\GvibratingResource\Pages;

use App\Filament\Resources\GvibratingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListGvibratings extends ListRecords
{
    protected static string $resource = GvibratingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->label('Add New Vibrating'),
        ];
    }
}
