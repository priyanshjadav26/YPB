<?php

namespace App\Filament\Resources\BlasiyaResource\Pages;

use App\Filament\Resources\BlasiyaResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateBlasiya extends CreateRecord
{
    protected static string $resource = BlasiyaResource::class;
    protected function getRedirectUrl(): string
    {
        return url('/admin/blasiyas');
    }
    public function getHeading(): string
    {
        return 'Create Lasiya';
    }
}
