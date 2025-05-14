<?php

namespace App\Filament\Resources\PendingstockResource\Pages;

use App\Filament\Resources\PendingstockResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePendingstock extends CreateRecord
{
    protected static string $resource = PendingstockResource::class;

    protected function getRedirectUrl(): string
    {
        return url('/admin/pendingstocks');
    }
}
