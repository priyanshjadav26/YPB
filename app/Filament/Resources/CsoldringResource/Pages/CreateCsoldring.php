<?php

namespace App\Filament\Resources\CsoldringResource\Pages;

use App\Filament\Resources\CsoldringResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCsoldring extends CreateRecord
{
    protected static string $resource = CsoldringResource::class;
    protected function getRedirectUrl(): string
    {
        return url('/admin/csoldrings');
    }
    public function getHeading(): string
    {
        return 'Create Soldring';
    }
}
