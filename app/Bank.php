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

    public function bank_accounts() 
    {
        return $this->hasMany('App\Bank_account', 'bank_code', 'bank_code');
    }
}
