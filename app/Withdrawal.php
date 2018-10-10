<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    protected $fillable = ['user_id', 'project_id', 'account_number', 'bank_id', 'account_name', 'amount', 'status', 'attachment'];

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
        return $this->belongsTo('App\Bank');
    }
}
