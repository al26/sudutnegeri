<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bank_account extends Model
{
    use SoftDeletes;
    protected $fillable = ['bank_code', 'bank_address', 'account_name', 'account_number'];
    protected $dates = ['deleted_at'];

    public function bank()
    {
        return $this->belongsTo('App\Bank', 'bank_code', 'bank_code');
    }
}
