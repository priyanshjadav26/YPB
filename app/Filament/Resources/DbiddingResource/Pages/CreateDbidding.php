<?php

namespace App\Filament\Resources\DbiddingResource\Pages;

use App\Filament\Resources\DbiddingResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDbidding extends CreateRecord
{
    protected static string $resource = DbiddingResource::class;
    protected function getRedirectUrl(): string
    {
        return url('/admin/dbiddings');
    }
    public function getHeading(): string
    {
        return 'Create Bidding';
    }
}
