<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcastingReceive extends Model
{
    use HasFactory;
    protected $fillable = [
        'acasting_id',
        'receive_date',
        'receive_weight',
        'rate',
        'total',
    ];

    
    public function acasting() {
        return $this->belongsTo(Acasting::class);
    }
    public function receives()
        {
            return $this->hasMany(AcastingReceive::class);
        }

    
}

