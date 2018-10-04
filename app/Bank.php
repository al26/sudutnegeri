<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    protected $fillable = ['bank_name', 'bank_code', 'logo'];

    public function donations() 
    {
        return $this->hasMany('App\Donation', 'bank_code', 'bank_code');
    }
}
