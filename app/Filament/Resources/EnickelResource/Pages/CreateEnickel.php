<?php

namespace App\Filament\Resources\EnickelResource\Pages;

use App\Filament\Resources\EnickelResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateEnickel extends CreateRecord
{
    protected static string $resource = EnickelResource::class;

    protected function getRedirectUrl(): string
    {
        return url('/admin/enickels');
    }
    public function getHeading(): string
    {
        return 'Create Nickel';
    }
}
