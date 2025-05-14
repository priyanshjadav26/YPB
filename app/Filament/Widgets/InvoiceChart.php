<?php

// namespace App\Filament\Widgets;

// use Filament\Widgets\ChartWidget;
// use App\Models\invoice;
// use Flowframe\Trend\Trend;
// use Flowframe\Trend\TrendValue;

// class InvoiceChart extends ChartWidget
// {
//     protected static ?string $heading = 'Invoice';

//     protected function getData(): array
//     {
//         $data = Trend::model(invoice::class)
//         ->between(
//             start: now()->startOfYear(),
//             end: now()->endOfYear(),
//         )
//         ->perMonth()
//         ->count();
 
//     return [
//         'datasets' => [
//             [
//                 'label' => 'Invoice',
//                 'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
//             ],
//         ],
//         // 'labels' => $data->map(fn (TrendValue $value) => $value->date),
//         'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
//     ];
//     }

//     protected function getType(): string
//     {
//         return 'bar';
//     }
// }
