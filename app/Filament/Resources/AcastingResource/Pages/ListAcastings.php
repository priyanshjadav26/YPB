<?php

namespace App\Filament\Resources\AcastingResource\Pages;
use Illuminate\View\View;
use App\Filament\Resources\AcastingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAcastings extends ListRecords
{
    protected static string $resource = AcastingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make()
            ->label('Add New Casting'),



        ];
    }

    public array $data_list = [
        'calc_columns' => [
            'total',
        ],
    ];
    protected function getTableContentFooter(): ?View
{
    $records = $this->getRecords();
    $grandTotal = $records->sum('receives.total');

    return view('table.footer', compact('grandTotal'));
}
}

