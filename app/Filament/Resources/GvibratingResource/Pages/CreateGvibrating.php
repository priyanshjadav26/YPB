<?php

namespace App\Filament\Resources\GvibratingResource\Pages;

use App\Filament\Resources\GvibratingResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateGvibrating extends CreateRecord
{
    protected static string $resource = GvibratingResource::class;

    protected function getRedirectUrl(): string
    {
        return url('/admin/gvibratings');
    }
    public function getHeading(): string
    {
        return 'Create vibrating';
    }
}
