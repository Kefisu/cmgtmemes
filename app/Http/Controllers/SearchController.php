<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Tag;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        {
            $posts = Post::orderBy('id', 'desc')->get()->load('tags');

            $random = $posts->where('featured', 1)->all();
            if (count($random) != 0):
                $random = $posts->where('featured', 1)->random(1)->first();
            else:
                $random = null;
            endif;

            if ($request->isMethod('post')) :
                if ($request->input('searchKey') != null) :
                    $searchKey = $request->input('searchKey');

                    $posts = Post::search($searchKey)->get();
                    $tags = Tag::search($searchKey)->get();

                    $data = [
                        'title' => 'Search - ' . $request->input('searchKey'),
                        'tags' => $tags,
                        'posts' => $posts,
                        'randomHeader' => $random
                    ];

                    return view('search.index')->with($data);
                else :
                    return view('search.index')->with(['title' => 'search', 'randomHeader' => $random]);
                endif;
            else :
                return view('search.index')->with(['title' => 'search', 'randomHeader' => $random]);
            endif;
        }
    }
}
