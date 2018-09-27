<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Data_historis extends Model
{
    use SoftDeletes;
    protected $fillable = ['user_id', 'project_id', 'title', 'body'];    
    protected $dates = ['deleted_at'];
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function project()
    {
        return $this->belongsTo('App\Project');
    }
}
