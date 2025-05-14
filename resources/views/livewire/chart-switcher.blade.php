<!-- resources/views/livewire/chart-switcher.blade.php -->

<div class="flex space-x-4">
    <label>
        <input type="checkbox" wire:model="showProducts" /> Products
    </label>
    <label>
        <input type="checkbox" wire:model="showInvoices" /> Invoices
    </label>
    <label>
        <input type="checkbox" wire:model="showSales" /> Sales
    </label>
    <label>
        <input type="checkbox" wire:model="showClients" /> Clients
    </label>
</div>