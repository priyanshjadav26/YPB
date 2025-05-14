<?php

namespace App\Filament\Resources\ReadyproductResource\Pages;

use App\Filament\Resources\ReadyproductResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateReadyproduct extends CreateRecord
{
    protected static string $resource = ReadyproductResource::class;

    protected function getRedirectUrl(): string
    {
        return url('/admin/readyproducts');
    }
    
}
