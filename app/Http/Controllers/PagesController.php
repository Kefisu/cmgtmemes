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
        $posts = Post::with('tags')->orderBy('id', 'desc')->paginate(10);
        // Select all featured posts
        $featured = Post::with('tags')->orderBy('id', 'desc')->where('featured', 1)->paginate(2);

        // Select random posts
        $random = $posts->where('featured', 1)->all();
        if (count($random) != 0):
            $random = $posts->where('featured', 1)->random(1)->first();
        else:
            $random = null;
        endif;

        // Get all posts and associated tags
        $data = [
            'header' => 'red',
            'posts' => $posts,
            'featured' => $featured,
            'tags' => Tag::all(),
            'randomHeader' => $random
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
