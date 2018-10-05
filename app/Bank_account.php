<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bank_account extends Model
{
    protected $fillable = ['bank_code', 'bank_address', 'account_name', 'account_number'];

    public function bank()
    {
        return $this->belongsTo('App\Bank', 'bank_code', 'bank_code');
    }
}
