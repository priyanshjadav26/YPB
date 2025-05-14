<?php

// namespace App\Filament\Widgets;
// use Flowframe\Trend\Trend;
// use Flowframe\Trend\TrendValue;
// use App\Models\Client;

// use Filament\Widgets\ChartWidget;

// class ClientsChart extends ChartWidget
// {
//     protected static ?string $heading = 'Total Clients';

//     protected function getData(): array
//     {

//         $data = Trend::model(Client::class)
//         ->between(
//             start: now()->startOfYear(),
//             end: now()->endOfYear(),
//         )
//         ->perMonth()
//         ->count();

//          return [
//         'datasets' => [
//             [
//                 'label' => 'Clients',
//                 'label' => 'Products',
//                 'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
//             ],
//         ],
//         'labels' => $data->map(fn (TrendValue $value) => $value->date),
//     ];

//     }

//     protected function getType(): string
//     {
//         return 'line';
//     }
// }
