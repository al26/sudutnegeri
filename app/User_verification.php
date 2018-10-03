<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_verification extends Model
{
    protected $fillable = ['user_profile_id', 'scan_id_card', 'verification_picture', 'status' ];
    
    public function profile()
    {
        return $this->belongsTo('App\User_profile');
    }
}
