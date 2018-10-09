<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Additional_question extends Model
{
    // use SoftDeletes;
    protected $fillable = ['project_id', 'question'];
    // protected $dates = ['deleted_at'];
    // public $timestamps = false;

    public function project() 
    {
        return $this->belongsTo('App\Project');
    }

    public function answers() 
    {
        return $this->hasMany('App\Additional_answer');
    }
}
