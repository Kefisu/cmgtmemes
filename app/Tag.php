<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Tag extends Model
{
    public function posts() {
        return $this->belongsToMany(Post::class);
    }

    use Searchable;
    public function toSearchableArray()
    {
        $array = $this->load('posts')->toArray();

        return $array;
    }
}
