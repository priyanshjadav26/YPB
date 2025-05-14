<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
    protected $fillable = [
        'category',
        'name',
        'purchase_party',
        'quantity',
        'price',
        'total',
    ];
    protected static function booted()
    {
        static::saving(function ($purchase) {
            $purchase->total = $purchase->quantity * $purchase->price;
        });
    }
}
