<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;

    protected $fillable = [
        'worker_id',
        'department',
        'from_date',
        'to_date',
        'given_salary',
        'givendate',
        'weight',
        'details',
        'receivedate',
        'receiveweight',
        'difference',
        'quantity',
        'rate',
        'total',
        
    ];

    public function worker()
    {
        return $this->belongsTo(Worker::class);
    }

 
}
