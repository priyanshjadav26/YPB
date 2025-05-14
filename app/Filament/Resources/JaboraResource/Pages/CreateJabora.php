<?php

namespace App\Filament\Resources\JaboraResource\Pages;

use App\Filament\Resources\JaboraResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateJabora extends CreateRecord
{
    protected static string $resource = JaboraResource::class;
    protected function getRedirectUrl(): string
    {
        return url('/admin/jaboras');
    }
    public function getHeading(): string
    {
        return 'Create Jabora';
    }

}
