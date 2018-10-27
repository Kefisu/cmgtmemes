<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Post extends Model
{
    public function tags() {
        return $this->belongsToMany(Tag::class);
    }

    use Searchable;
    public function toSearchableArray()
    {
       $array = $this->load('tags')->toArray();

        return $array;
    }
}
