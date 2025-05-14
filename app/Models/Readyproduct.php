<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Readyproduct extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',  
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
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
