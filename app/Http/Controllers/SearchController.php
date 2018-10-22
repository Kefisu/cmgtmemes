<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Tag;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        if ($request->isMethod('post')) :
            if ($request->input('searchKey') != null) :
                $searchKey = $request->input('searchKey');

                $posts = Post::search($searchKey)->get();
                $tags = Tag::search($searchKey)->get();

                $data = [
                    'title' => 'Search - '. $request->input('searchKey'),
                    'tags' => $tags,
                    'posts' => $posts
                ];

                return view('search.index')->with($data);
            else :
                return view('search.index')->with('title', 'search');
            endif;
        else :
            return view('search.index')->with('title', 'search');
        endif;
    }

    public function search()
    {

    }
}
