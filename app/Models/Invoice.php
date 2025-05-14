<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = ['client_id', 'total_amount', 'invoice_date'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function items()
    {
        return $this->hasMany(InvoiceItem::class);
    }

    protected static function booted()
    {
        static::saving(function ($invoice) {
            $invoice->total_amount = $invoice->items->sum(fn ($item) => $item->total + $item->gst_amount);
        });
    }
        public function product()
    {
        return $this->belongsTo(App\Models\Product::class, 'product_id');
    }
}