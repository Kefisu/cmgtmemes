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

    public static function randomPost() {
        // Get random featured post
        $posts = Post::orderBy('id' , 'desc')->where('featured', 1)->get();
        if (count($posts) != 0):
            return $posts->random(1)->first();
        else:
           return null;
        endif;
    }
}
