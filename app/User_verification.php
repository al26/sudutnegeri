<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_verification extends Model
{
    protected $fillable = ['scan_id_card', 'verification_picture' ];
    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
