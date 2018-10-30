<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Tag;

class PagesController extends Controller
{
    public function index()
    {
        // Select all posts and paginate
        $posts = Post::with('tags')->orderBy('id', 'desc')->paginate(10, ['*'], 'posts');
        // Select all featured posts
        $featured = Post::with('tags')->orderBy('id', 'desc')->where('featured', 1)->paginate(2, ['*'], 'featured');

        // Get all posts and associated tags
        $data = [
            'header' => 'red',
            'posts' => $posts,
            'featured' => $featured,
            'tags' => Tag::all(),
            'randomHeader' => Post::randomPost()
        ];

        // Return view with all posts & tags
//        return view('app.index')->with($data);
        return response()
            ->view('app.index', $data)
            ->header('Cache-Control', 'max-age=86400');
    }

    public function privacy()
    {

        $data = [
            'randomHeader' => null,
            'title' => 'Privacyverklaring'
        ];

        return view('privacy')->with($data);
    }
}
