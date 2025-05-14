<?php

// namespace App\Filament\Widgets;

// use Filament\Widgets\ChartWidget;
// use App\Models\Readyproduct;
// use Flowframe\Trend\Trend;
// use Flowframe\Trend\TrendValue;

// class ReadyproductChart extends ChartWidget
// {
//     protected static ?string $heading = 'Sales';

//     protected function getData(): array
//     {
//         $data = Trend::model(Readyproduct::class)
//         ->between(
//             start: now()->startOfYear(),
//             end: now()->endOfYear(),
//         )
//         ->perMonth()
//         ->count();
 
//     return [
//         'datasets' => [
//             [
//                 'label' => 'Sales',
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
