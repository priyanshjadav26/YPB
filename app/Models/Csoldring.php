<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Csoldring extends Model
{
    use HasFactory;
    protected $fillable = [
        'worker_id',
        'givendate',
        'details',
        'casting_weight',
        'lasiya_weight',
        'givenweight',
        'receivedate',
        'receiveweight',
        'difference',
        'rate',
        'piece',
        'total',
    ];
     // Define the relationship with the Worker model (to fatch worker name )
     public function worker()
     {
         return $this->belongsTo(Worker::class);
     }

     // Calculate total before saving the model(rweight*rate=total)
    // public static function boot()
    // {
    //     parent::boot();

    //     static::saving(function ($model) {
    //         $model->total = $model->givenweight * $model->rate;
    //         // $model->givenweight = $model->casting_weight + $model->lasiya_weight;
    //         $model->difference = $model->givenweight - $model->receiveweight;
    //     });
        
    // }


    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->givenweight = $model->casting_weight + $model->lasiya_weight; // Ensure givenweight is calculated
            $model->total = $model->rate * $model->piece; // Calculate total based on rate and pieces
            $model->difference = $model->givenweight - $model->receiveweight;
        });
    }

}

