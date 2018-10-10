<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

class Bank extends Model
{
    // use SoftDeletes;
    // protected $primaryKey = "bank_code";
    protected $fillable = ['bank_name', 'bank_code', 'logo'];
    // protected $dates = ['deleted_at'];

    public function donations() 
    {
        // return $this->hasMany('App\Donation', 'bank_code', 'bank_code');
        return $this->hasMany('App\Donation');
    }

    public function bank_accounts() 
    {
        // return $this->hasMany('App\Bank_account', 'bank_code', 'bank_code');
        return $this->hasMany('App\Bank_account');
    }

    public function withdrawals()
    {
        return $this->hasMany('App\Withdrawal');
    }
}
