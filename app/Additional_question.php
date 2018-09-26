<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Additional_question extends Model
{
    protected $fillable = ['project_id', 'question'];
    public $timestamps = false;

    public function project() 
    {
        return $this->belongsTo('App\Project');
    }

    public function answers() 
    {
        return $this->hasMany('App\Additional_answer');
    }
}
