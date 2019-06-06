<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tutorial extends Model
{
    public function user(){
        return $this->belongsTo('App\User');
    }

    public function tutorialLike(){
        return $this->hasMany('App\TutorialLike');
    }
}
