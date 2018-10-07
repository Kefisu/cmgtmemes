<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Tag;

class PagesController extends Controller
{
    public function index()
    {

        // Get all posts and associated tags
        $data = [
            'header' => 'red',
            'posts' => $posts = Post::orderBy('id' , 'desc')->get()->load('tags'),
            'tags' => $tags = Tag::all()
        ];
        // Return view with all posts & tags
        return view('app.index')->with($data);
    }
}
