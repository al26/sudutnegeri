<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Additional_answer extends Model
{
    protected $fillable = ['question_id', 'answer'];

    public function question()
    {
        return $this->belongsTo('App\Additional_question');
    }

    public function volunteer()
    {
        return $this->belongsTo('App\Volunteer');
    }
}
