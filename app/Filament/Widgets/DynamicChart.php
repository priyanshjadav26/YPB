<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\Invoice;
use App\Models\Readyproduct;
use App\Models\Client;
use App\Models\Product;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Illuminate\Support\Carbon;

class DynamicChart extends ChartWidget
{
    protected static ?string $heading = 'Dynamic Chart';
    protected static ?int $sort = 3;
    // protected int | string | array $columnSpan = 'full';
    protected int | string | array $columnSpan = 'md';
    protected int | string $height = '60rem';
    // protected int | string $height = '50%';
    
    
    
    public bool $showProducts = true;
    public bool $showInvoices = true;
    public bool $showSales = true;
    public bool $showClients = true;

    protected function getListeners(): array
    {
        return [
            'updateChartVisibility' => 'updateVisibility'
        ];
    }

    public function updateVisibility(array $visibility)
    {
        $this->showProducts = $visibility['showProducts'];
        $this->showInvoices = $visibility['showInvoices'];
        $this->showSales = $visibility['showSales'];
        $this->showClients = $visibility['showClients'];

        $this->updateChart();
    }

    protected function getData(): array
    {
        $datasets = [];

        if ($this->showProducts) {
            $data = Trend::model(Product::class)
                ->between(start: now()->startOfYear(), end: now()->endOfYear())
                ->perMonth()
                ->count();
            
            $datasets[] = [
                'label' => 'Products',
                'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                'backgroundColor' => 'rgba(255, 99, 132, 0.2)', // Custom color
                'borderColor' => 'rgba(255, 99, 132, 1)', // Custom color
            ];
        }

        if ($this->showInvoices) {
            $data = Trend::model(Invoice::class)
                ->between(start: now()->startOfYear(), end: now()->endOfYear())
                ->perMonth()
                ->count();
            
            $datasets[] = [
                'label' => 'Invoices',
                'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                'backgroundColor' => 'rgba(54, 162, 235, 0.2)', // Custom color
                'borderColor' => 'rgba(54, 162, 235, 1)', // Custom color
            ];
        }

        if ($this->showSales) {
            $data = Trend::model(Readyproduct::class)
                ->between(start: now()->startOfYear(), end: now()->endOfYear())
                ->perMonth()
                ->count();
            
            $datasets[] = [
                'label' => 'Sales',
                'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                'backgroundColor' => 'rgba(75, 192, 192, 0.2)', // Custom color
                'borderColor' => 'rgba(75, 192, 192, 1)', // Custom color
            ];
        }

        if ($this->showClients) {
            $data = Trend::model(Client::class)
                ->between(start: now()->startOfYear(), end: now()->endOfYear())
                ->perMonth()
                ->count();
            
            $datasets[] = [
                'label' => 'Clients',
                'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                'backgroundColor' => 'rgba(153, 102, 255, 0.2)', // Custom color
                'borderColor' => 'rgba(153, 102, 255, 1)', // Custom color
            ];
        }

        return [
            'datasets' => $datasets,
            'labels' => $data->map(fn (TrendValue $value) => Carbon::parse($value->date)->format('M')),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
