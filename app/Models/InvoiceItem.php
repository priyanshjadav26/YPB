<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceItem extends Model
{
    use HasFactory;

    protected $fillable = ['invoice_id', 'product_id', 'quantity', 'price', 'total', 'gst_rate', 'gst_amount'];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    protected static function booted()
    {
        static::saving(function ($invoiceItem) {
            $invoiceItem->gst_rate = $invoiceItem->gst_rate ?? 0;  // Default to 0 if null
            $invoiceItem->total = $invoiceItem->price * $invoiceItem->quantity;
            $invoiceItem->gst_amount = ($invoiceItem->total * $invoiceItem->gst_rate) / 100;
        });

        static::saved(function ($invoiceItem) {
            $invoice = $invoiceItem->invoice;
            $invoice->total_amount = $invoice->items->sum(fn ($item) => $item->total + $item->gst_amount);
            $invoice->save();
        });
    }
}