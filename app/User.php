<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function socialAccounts() {
        return $this->hasMany('App\SocialAccount');
    }

    public function profile() {
        return $this->hasOne('App\User_profile');
    }

    public function verify() {
        return $this->hasOne('App\User_verification');
    }

    public function projects() {
        return $this->hasMany('App\Project');
    }

    public function volunteers() 
    {
        return $this->hasMany('App\Volunteer');
    }
}
