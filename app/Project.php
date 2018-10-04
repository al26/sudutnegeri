<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;

    protected $fillable = ['user_id', 'project_name', 'category_id', 'project_slug', 'project_description', 'funding_target', 'funding_progress', 'volunteer_quota', 'registered_volunteer', 'project_banner', 'regency_id', 'close_donation', 'close_reg'];    
    protected $dates = ['deleted_at'];
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function historis()
    {
        return $this->hasMany('App\Data_historis');
    }

    public function donations() 
    {
        return $this->hasMany('App\Donation');
    }

    public function volunteers() 
    {
        return $this->hasMany('App\Volunteer');
    }

    public function questions()
    {
        return $this->hasMany('App\Additional_question');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function location()
    {
        return $this->belongsTo('App\Regency', 'regency_id');
    }

    public function withdrawal()
    {
        return $this->hasMany('App\Withdrawal');
    }
}
