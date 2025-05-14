<?php

namespace App\Filament\Resources\IfittingResource\Pages;

use App\Filament\Resources\IfittingResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateIfitting extends CreateRecord
{
    protected static string $resource = IfittingResource::class;
    protected function getRedirectUrl(): string
    {
        return url('/admin/ifittings');
    }
    public function getHeading(): string
    {
        return 'Create fitting';
    }
}
