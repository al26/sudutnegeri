<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    public function regencies() 
    {
        return $this->hasMany('App\Regency');
    }

    public function address() 
    {
        return $this->hasMany('App\User_address');
    }
}
