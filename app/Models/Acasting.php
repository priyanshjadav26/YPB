<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acasting extends Model
{
    use HasFactory;

    protected $fillable = [
        'worker_id',
        'givendate',
        'weight',
        'details',
        'difference',
        'receivedate',
        'receiveweight',
        'rate',
        'total',
        
       
    ];

    // Define the relationship with the Worker model (to fetch worker name)
    public function worker()
    {
        return $this->belongsTo(Worker::class);
    }

    public function receives()
    {
        return $this->hasMany(AcastingReceive::class);
    }
    
    // Calculate total before saving the model (rweight * rate = total)
    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->receiveweight = $model->receiveweight ? (float) $model->receiveweight : 0.0;
            $model->rate = $model->rate ? (float) $model->rate : 0.0;
            $model->total = $model->weight * $model->rate;
           
             // Calculate weight difference only if receives are present
             if ($model->receives()->exists()) {
                $totalReceiveWeight = $model->receives->sum('receive_weight');
                $model->difference = $model->weight - $totalReceiveWeight;
            } else {
                $model->difference = 0.0; // Default difference when no receives
            }
        });
    } 

    public function getWeightDifferenceAttribute()
    {
        $totalReceiveWeight = $this->receives->sum('receive_weight');
        return number_format($this->weight - $totalReceiveWeight, 2); 
        return number_format($this->difference, 2); 
    }

  
}
