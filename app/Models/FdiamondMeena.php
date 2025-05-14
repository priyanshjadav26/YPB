<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FdiamondMeena extends Model
{
    use HasFactory;
    protected $fillable = [
        'worker_id',
        'givendate',
        'weight',
        'dimond_weight',
        'details',
        'receivedate',
        'receiveweight',
        'difference',
        'no_of_dimond',
        'rate',
        'total',
    ];
     // Define the relationship with the Worker model (to fatch worker name )
     public function worker()
     {
         return $this->belongsTo(Worker::class);
     }

     // Calculate total before saving the model(rweight*rate=total)
    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->total = $model->no_of_dimond * $model->rate;
            $model->difference = $model->weight - $model->receiveweight;
        });
    }
}
