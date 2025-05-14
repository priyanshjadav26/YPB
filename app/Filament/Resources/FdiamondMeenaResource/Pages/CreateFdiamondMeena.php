<?php

namespace App\Filament\Resources\FdiamondMeenaResource\Pages;

use App\Filament\Resources\FdiamondMeenaResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateFdiamondMeena extends CreateRecord
{
    protected static string $resource = FdiamondMeenaResource::class;
 
    
    protected function getRedirectUrl(): string
    {
        return url('/admin/fdiamond-meenas');
    }

    public function getHeading(): string
    {
        return 'Create Dimond/Meena';
    }
}
