<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Donation extends Model
{
    // use SoftDeletes;
    
    protected $fillable = ['user_id', 'project_id', 'bank_code', 'amount', 'anonymouse', 'status', 'transfer_receipt', 'payment_code'];
    // protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function project()
    {
        return $this->belongsTo('App\Project');
    }

    public function bank()
    {
        return $this->belongsTo('App\Bank', 'bank_code', 'bank_code');
    }
}
