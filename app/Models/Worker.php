<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    use HasFactory;
    protected $fillable = 
        [
            'name',
            'contact',
            'department',
            'salary',
        ];

        public function salaries()
    {
        return $this->hasMany(Salary::class);
    }
    
    public function scopeCasting($query)
    {
        return $query->where('department', 'Casting');
    }

    public function hpackagings()
    {
        return $this->hasMany(Hpackaging::class);
    }
    public function Gvibrating()
    {
        return $this->hasMany(Gvibrating::class);
    }
    public function Blasiya()
    {
        return $this->hasMany(Blasiya::class);
    }
    public function Csoldring()
    {
        return $this->hasMany(Csoldring::class);
    }
    public function Enickel()
    {
        return $this->hasMany(Enickel::class);
    }
    public function FdiamondMeena()
    {
        return $this->hasMany(FdiamondMeena::class);
    }
    public function Acasting()
    {
        return $this->hasMany(Acasting::class);
    }
}
