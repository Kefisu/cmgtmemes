<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;
use App\Tag;
use Illuminate\Support\Facades\Auth;

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
        $post->title = strip_tags($request->input('title'));
        $post->author = strip_tags($this->author);
        $post->year = strip_tags($request->input('year'));
        $post->tagline = strip_tags($request->input('tagline'));
        $post->description = strip_tags($request->input('description'));
        $post->meme_image = strip_tags($fileNameToStore);
        $post->user_id = auth()->user()->id;
        $post->slug = strip_tags(strtolower(str_replace(' ', '-', $request->input('title'))));
        $post->save();

        if (!empty($request->input('tags'))) :
            foreach ($request->input('tags') as $tag) :
                $post->tags()->attach($tag);
            endforeach;
        endif;

        return redirect('/post/' . $post->slug)->with('success', 'Meme uploaded');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($title, Request $request)
    {
        // Check if user is logged in and has correct role
        if(!$user = Auth::user())
        {
            $this->admin = false;
        } else {
            $this->admin = $request->user()->authorizeRoles('admin');
        }

        $data = [
            'post' => Post::where('slug', $title)->first()->load('tags'),
            'header' => 'white',
            'admin' => $this->admin
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
        $post = Post::find($id);

        // Check for correct user
        if (auth()->user()->id !== $post->user_id) {
            return redirect('/login')->with('error', 'Unauthorized page');
        }

        if ($post->meme_image != 'noimage.jpg') {
            // Delete image
            Storage::delete('public/uploads/' . $post->meme_image);
        }

        $post->delete();
        return redirect('/upload')->with('success', 'Meme removed');
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function featured(Request $request, $id)
    {
        $featured = $request->input('featured');
        $post = Post::find($id);
        if (isset($featured)) {
            // Feature meme
            $post->featured = 1;
            $post->save();

            return redirect('/post/' . $post->slug)->with('success', 'This meme is now featured');
        } else {
            // Unfeature meme
            $post->featured = 0;
            $post->save();

            return redirect('/post/' . $post->slug)->with('warning', 'This meme is not featured anymore');
        }


    }
}
