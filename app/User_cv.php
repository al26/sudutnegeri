<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_cv extends Model
{
    protected $fillable = ['education', 'foreign_lang', 'pro_exp', 'org_exp'];

    public function profile()
    {
        return $this->belongsTo('App\Profile');
    }
}
