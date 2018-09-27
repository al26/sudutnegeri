<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Regency extends Model
{
    public function province()
    {
        return $this->belongsTo('App\Province');
    }

    public function districts() 
    {
        return $this->hasMany('App\District');
    }

    public function address() 
    {
        return $this->hasOne('App\User_address');
    }

    public function projects()
    {
        return $this->hasMany('App\Project', 'project_location', 'id');
    }
}
