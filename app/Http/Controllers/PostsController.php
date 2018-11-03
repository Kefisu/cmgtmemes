<?php

namespace App\Http\Controllers;

use App\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;
use App\Tag;
use Illuminate\Support\Facades\Auth;
use App\Http\Helpers;

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
        // Check user status
        $unlocked = helpers::checkUserStatus();
        // True if user role admin
        if ($request->user()->authorizeRoles('admin')) {
            $unlocked = true;
        }

        $data = [
            'header' => 'white',
            'title' => 'Upload meme',
            'randomHeader' => Post::randomPost(),
            'unlocked' => $unlocked
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
        // Brute force algolia update
        $post->save();


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
        if (!$user = Auth::user()) {
            $this->admin = false;
        } else {
            $this->admin = $request->user()->authorizeRoles('admin');
        }

        // Get post data
        $post = Post::where('slug', $title)->first()->load('tags');
        // Get rating data
        $ratings = Rating::where('post_id', $post->id)->get();

        $this->rating = $ratings->avg('rating', 1);
        if ($this->rating == null) :
            $this->rating = 0;
        endif;
        // Determine if user has rated
        if (isset(Auth::user()->id) && $ratings->where('user_id', Auth::user()->id)->count() > 0):
            $this->rated = true;
        else:
            $this->rated = false;
        endif;

        $data = [
            'post' => $post,
            'header' => 'white',
            'admin' => $this->admin,
            'rated' => $this->rated,
            'rating' => $this->rating
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
        $post = Post::where('slug', $title)->first()->load('tags');

        if ($post->user_id !== Auth::user()->id) {
            return redirect(url('/post', $title))->with('error', 'Geen toegang tot deze pagina');
        }

        $data = [
            'header' => 'white',
            'title' => 'Edit post',
            'randomHeader' => $post,
            'post' => $post
        ];

        return view('app.posts.edit')->with($data);
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

        $post = Post::find($id);

        $post->title = strip_tags($request->input('title'));
        $post->author = strip_tags($this->author);
        $post->year = strip_tags($request->input('year'));
        $post->tagline = strip_tags($request->input('tagline'));
        $post->description = strip_tags($request->input('description'));
        $post->user_id = auth()->user()->id;
        $post->slug = strip_tags(strtolower(str_replace(' ', '-', $request->input('title'))));
        $post->save();

        $this->post = collect($post);

        if (!empty($request->input('tags'))) :
            foreach ($request->input('tags') as $tag) :
                if (!$this->post->contains($tag)) :
                    $post->tags()->attach($tag);
                endif;
            endforeach;
        endif;
        // Brute force algolia update
        $post->save();


        return redirect('/post/' . $post->slug)->with('success', 'Meme bewerkt');
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
        $post->tags()->detach();
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
