<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;
    protected $fillable = ["category", "slug"];
    protected $dates = ['deleted_at'];

    public function project()
    {
        return $this->hasMany('App\Project');
    }
}
