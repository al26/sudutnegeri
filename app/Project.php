<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;
    protected $fillable = ['user_id','project_name', 'project_slug', 'description', 'funding_target', 'funding_progress', 'volunteer_spot', 'volunteer_applied', 'project_banner', 'location','deadline'];    
    protected $dates = ['deleted_at'];
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function historis()
    {
        return $this->hasMany('App\Data_historis');
    }
}
