<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Tag;

class TagsController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  String
     * @return Bool
     */
    public function store($slug)
    {
        $name = $slug;
        $tag = new Tag;
        $tag->name = $name;
        $tag->save();

        return 'success';
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($tag)
    {
        $tags = Tag::with('posts')->where('name', $tag)->paginate(10, ['*'], 'posts');

        $data = [
            'header' => 'white',
            'posts' => $tags,
            'randomHeader' => Post::randomPost()
        ];

        return view('app.tag.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function get()
    {
        return Tag::orderBy('id', 'desc')->get();
    }
}
