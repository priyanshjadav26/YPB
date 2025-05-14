<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
    
        'name',
        'price',
        'quantity',
        'quantity_type',
        'total',
        'stock',
        'stock_amount',
        'gst_rate',
        'gst_amount',
    ];


    public function updateStockAmount()
    {
        $this->stock_amount = $this->total * $this->stock;
    }

    public function readyProduct()
    {
        return $this->hasOne(Readyproduct::class);
    }
    protected static function booted()
    {
        static::saving(function ($product) {
            $product->total = $product->price * $product->quantity;
            $product->gst_amount = $product->total * $product->gst_rate / 100;
            $product->updateStockAmount();
        });
    }
    

}
