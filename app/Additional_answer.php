<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Additional_answer extends Model
{
    use SoftDeletes;

    protected $fillable = ['volunteer_id', 'question_id', 'answer'];
    protected $dates = ['deleted_at'];

    public function question()
    {
        return $this->belongsTo('App\Additional_question');
    }

    public function volunteer()
    {
        return $this->belongsTo('App\Volunteer');
    }
}
