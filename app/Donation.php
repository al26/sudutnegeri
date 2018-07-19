<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    protected $fillable = ['user_id', 'project_id', 'bank_id', 'amount', 'anonymouse', 'status', 'transfer_receipt'];

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
        return $this->hasOne('App\Bank');
    }
}
