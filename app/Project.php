<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;

    protected $fillable = ['user_id', 'project_name', 'project_slug', 'project_description', 'funding_target', 'funding_progress', 'volunteer_quota', 'registered_volunteer', 'project_banner', 'project_location', 'project_deadline'];    
    protected $dates = ['deleted_at'];
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function historis()
    {
        return $this->hasMany('App\Data_historis');
    }

    public function donation() 
    {
        return $this->hasOne('App\Donation');
    }
}
