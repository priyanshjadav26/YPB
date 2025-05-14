<?php

namespace App\Filament\Resources\RawmaterialResource\Pages;

use App\Filament\Resources\RawmaterialResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateRawmaterial extends CreateRecord
{
    protected static string $resource = RawmaterialResource::class;
    protected function getRedirectUrl(): string
    {
        return url('/admin/rawmaterials');
    }
}
