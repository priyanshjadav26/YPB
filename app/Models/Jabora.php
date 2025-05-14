<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabora extends Model
{
    use HasFactory;

    protected $fillable = [
        'worker_id',
        'givendate',
        'weight',
        'details',
        'receivedate',
        'receiveweight',
        'difference',
        'rate',
        'total',
    ];

    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->total = $model->weight * $model->rate;
            $model->difference = $model->weight - $model->receiveweight;
        });
    }
    
    public function worker()
    {
        return $this->belongsTo(Worker::class);
    }

}
