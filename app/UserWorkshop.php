<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserWorkshop extends Model
{
    public function user(){
        return $this->belongsTo('App\User');
    }

    public function workshop(){
        return $this->belongsTo('App\Workshop');
    }
}
