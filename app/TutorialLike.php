<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TutorialLike extends Model
{
    public function user(){
        return $this->belongsTo('App\User');
    }

    public function tutorial(){
        return $this->belongsTo('App\Tutorial');
    }
}
