<?php

// namespace App\Filament\Resources\InvoiceResource\Pages;

// use App\Filament\Resources\InvoiceResource;
// use Filament\Actions;
// use Filament\Resources\Pages\EditRecord;
// use Barryvdh\DomPDF\Facade as PDF;

// class EditInvoice extends EditRecord
// {
//     protected static string $resource = InvoiceResource::class;

//     protected function getHeaderActions(): array
//     {
//         return [
//             Actions\DeleteAction::make(),
//         ];
//     }
//     protected function getActions(): array
//     {
//         return [
//             Action::make('Download Normal Bill')
//                 ->action('downloadNormalBill')
//                 ->color('success')
//                 ->icon('heroicon-o-download'),
//             Action::make('Download GST Bill')
//                 ->action('downloadGstBill')
//                 ->color('warning')
//                 ->icon('heroicon-o-download'),
//         ];
//     }
// }




namespace App\Filament\Resources\InvoiceResource\Pages;

use App\Filament\Resources\InvoiceResource;
use Filament\Resources\Pages\EditRecord;
use Filament\Pages\Actions\Action;
use Barryvdh\DomPDF\Facade as PDF;

class EditInvoice extends EditRecord
{
    protected static string $resource = InvoiceResource::class;

    protected function getActions(): array
    {
        return [
            Action::make('Download Normal Invoice')
                ->action('downloadNormalInvoice')
                ->color('success'),
                // ->icon('heroicon-o-download'),
            Action::make('Download GST Invoice')
                ->action('downloadGstInvoice')
                ->color('warning')
                // ->icon('heroicon-o-download'),
        ];
    }

    public function downloadNormalInvoice()
    {
        $data = ['invoice' => $this->record];
        $pdf = PDF::loadView('invoices.normal_invoice', $data);

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, 'normal_invoice.pdf');
    }

    public function downloadGstInvoice()
    {
        $data = ['invoice' => $this->record];
        $pdf = PDF::loadView('invoices.gst_invoice', $data);

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->stream();
        }, 'gst_invoice.pdf');
    }

    protected function getRedirectUrl(): string
    {
        return url('/admin/invoices');
    }
}