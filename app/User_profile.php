<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_profile extends Model
{
    protected $fillable = ['name', 'gender', 'dob', 'address', 'phone_number', 'biography', 'profession', 'institution', 'interest', 'skills', 'profile_picture', 'identity_card', 'identity_number'];    

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function address() 
    {
        return $this->hasOne('App\User_address');
    }

    public function verification() {
        return $this->hasOne('App\User_verification', 'user_profile_id', 'id');
    }

    public function cv()
    {
        return $this->hasOne('App\User_cv');
    }
}
