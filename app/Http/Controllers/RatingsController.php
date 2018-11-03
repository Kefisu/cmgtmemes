<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rating;
use Illuminate\Support\Facades\Auth;

class RatingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => 'get']);
    }

    public function add($id, Request $request)
    {
        // Validate inpupt
        $this->validate($request, [
            'rating' => 'required'
        ]);

        // Insert rating in DB
        $rating = new Rating;
        $rating->user_id = Auth::user()->id;
        $rating->post_id = $id;
        $rating->rating = $request->input('rating');
        $rating->save();

        return redirect(route('showPost', $request->input('slug')))->with('success', 'Rating toegevoegd');
    }

    public function get()
    {

    }
}
