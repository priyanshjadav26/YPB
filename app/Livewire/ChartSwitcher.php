<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ChartSwitcher extends Component
{
    public bool $showProducts = true;
    public bool $showInvoices = true;
    public bool $showSales = true;
    public bool $showClients = true;

    public function updated($propertyName)
    {
        $this->emit('updateChartVisibility', [
            'showProducts' => $this->showProducts,
            'showInvoices' => $this->showInvoices,
            'showSales' => $this->showSales,
            'showClients' => $this->showClients,
        ]);
    }

    public function render()
    {
        return view('livewire.chart-switcher');
    }
}