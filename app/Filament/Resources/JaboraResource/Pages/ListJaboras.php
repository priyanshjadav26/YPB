<?php

namespace App\Filament\Resources\JaboraResource\Pages;

use App\Filament\Resources\JaboraResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListJaboras extends ListRecords
{
    protected static string $resource = JaboraResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->label('Add New Jabora'),
        ];
    }

    
}
