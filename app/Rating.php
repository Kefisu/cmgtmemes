<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    public function post() {
        $this->belongsTo('App\Post');
    }

    public function user() {
        $this->belongsTo('App\User');
    }
}
