<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Volunteer extends Model
{
    protected $fillable = ['user_id', 'project_id', 'motivation', 'eligibility', 'status'];

    public function user() 
    {
        return $this->belongsTo('App\User');
    }

    public function project() 
    {
        return $this->belongsTo('App\Project');
    }

    public function answers() 
    {
        return $this->hasMany('App\Additional_answer');
    }

}
