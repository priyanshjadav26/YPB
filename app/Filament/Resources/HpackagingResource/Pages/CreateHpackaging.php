<?php

namespace App\Filament\Resources\HpackagingResource\Pages;

use App\Filament\Resources\HpackagingResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateHpackaging extends CreateRecord
{
    protected static string $resource = HpackagingResource::class;
    protected function getRedirectUrl(): string
    {
        return url('/admin/hpackagings');
    }
    public function getHeading(): string
    {
        return 'Create Packaging';
    }
}
