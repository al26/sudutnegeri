<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_address extends Model
{
    protected $fillable = ['user_profile_id', 'province_id', 'regency_id', 'district_id', 'exact_location', 'zip_code'];

    public function profile() 
    {
        return $this->belongsTo('App\User_profile');
    }

    public function province() 
    {
        return $this->belongsTo('App\Province');
    }

    public function regency() 
    {
        return $this->belongsTo('App\Regency');
    }

    public function district() 
    {
        return $this->belongsTo('App\District');
    }
}
