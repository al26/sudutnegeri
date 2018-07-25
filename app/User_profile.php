<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_profile extends Model
{
    protected $fillable = ['name', 'gender', 'dob', 'address', 'phone_number', 'biography', 'profession', 'institution', 'interest', 'skills', 'profile_picture'];    

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function address() 
    {
        return $this->hasOne('App\User_address');
    }
}
