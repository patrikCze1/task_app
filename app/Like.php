<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    public function comments(){
        return $this->belongsTo('App\Comments');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
