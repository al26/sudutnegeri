<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Volunteer extends Model
{
    // use SoftDeletes;
    
    protected $fillable = ['user_id', 'project_id', 'motivation', 'eligibility', 'status'];
    // protected $dates = ['deleted_at'];

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
