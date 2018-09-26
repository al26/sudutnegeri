<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ["category", "slug"];

    public function project()
    {
        return $this->hasMany('App\Project');
    }
}
