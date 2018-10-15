<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show']]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $request->user()->authorizeRoles(['user', 'admin']);

        $data = [
            'header' => 'white'
        ];

        return view('app.posts.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'author' => 'nullable',
            'year' => 'required',
            'tagline' => 'required',
            'description' => 'required',
            'file' => 'image|nullable'
        ]);

        // Handle author
        if (empty($request->input('author'))) {
            $this->author = 'Annoniem';
        } else {
            $this->author = $request->input('author');
        }

        // Handle file upload
        if ($request->hasFile('file')) {
            // Get filename with its extension
            $filenameWithExt = $request->file('file')->getClientOriginalName();
            // Get filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get extension
            $extension = $request->file('file')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension;
            // Upload image
            $path = $request->file('file')->storeAs('public/uploads', $fileNameToStore);
        } else {
            $fileNameToStore = 'noimage.jpg';
        }

        $post = new Post;
        $post->title = $request->input('title');
        $post->author = $this->author;
        $post->year = $request->input('year');
        $post->tagline = $request->input('tagline');
        $post->description = $request->input('description');
        $post->meme_image = $fileNameToStore;
        $post->user_id = auth()->user()->id;
        $post->slug = strtolower(str_replace(' ', '-', $request->input('title')));
        $post->save();

        return redirect('/upload')->with('success', 'Post Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($title, Request $request)
    {
        $data = [
            'post' => Post::where('slug', $title)->first()->load('tags'),
            'header' => 'white',
        ];
        $data['header_image'] = $data['post']->meme_image;

        return view('app.posts.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($title)
    {
        $data = [

        ];

        return view()->with();
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
}
