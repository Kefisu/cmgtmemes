<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Tag;

class PagesController extends Controller
{
    public function index()
    {
        // Set max cache time header
        header('Cache-Control: max-age=84600');

        $posts = Post::orderBy('id' , 'desc')->get()->load('tags');

        // Get all posts and associated tags
        $data = [
            'header' => 'red',
            'posts' => $posts,
            'tags' => Tag::all(),
            'randomHeader' => $posts->where('featured', 1)->random(1)->first()
        ];

        // Return view with all posts & tags
        return view('app.index')->with($data);
    }
}
