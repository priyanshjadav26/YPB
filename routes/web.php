<?php
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('admin/invoices/normal', function () {
    $record = session()->pull('record');
    $data = [
        'invoice' => $record,
        'client' => $record->client,
        'items' => $record->items,
    ];

    $pdf = PDF::loadView('invoices.normal_bill', $data);

    return $pdf->download('normal_bill.pdf');
})->name('invoice.normal');

Route::get('admin/invoices/gst', function () {
    $record = session()->pull('record');
    $data = [
        'invoice' => $record,
        'client' => $record->client,
        'items' => $record->items,
    ];

    $pdf = PDF::loadView('invoices.gst_invoice', $data);

    return $pdf->download('gst_bill.pdf');
})->name('invoice.gst');