<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Client;
use App\Models\Product;
use App\Models\Worker;

class AdminWidgets extends BaseWidget
{
    protected function getStats(): array
{
    return [
        Stat::make(label:'Total clients', value: Client::all()->count())
                ->description(description:'increase in clients')
                ->descriptionIcon(icon:'heroicon-m-arrow-trending-up')
                ->color(color:'success')
                ->chart([7, 3, 4, 5, 6, 3, 5, 3]),
            Stat::make(label:'Total products', value: Product::all()->count())
                ->description(description:'increase in products')
                ->descriptionIcon(icon:'heroicon-m-arrow-trending-up')
                ->color(color:'success')
                ->chart([7, 3, 4, 5, 6, 3, 5, 3]),
            Stat::make(label:'Total workers', value: Worker::all()->count())
                ->description(description:'increase in workers')
                ->descriptionIcon(icon:'heroicon-m-arrow-trending-up')
                ->color(color:'success')
                ->chart([7, 3, 4, 5, 6, 3, 5, 3]),
    ];
}
}
