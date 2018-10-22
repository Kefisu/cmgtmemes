<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Tag;
use App\User;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $posts = Post::where('user_id', Auth::user()->id)->orderBy('id' , 'desc')->paginate(10);

        $data = [
            'posts' => $posts,
            'title' => 'Dashboard'
        ];

        return view('dashboard.user.index')->with($data);
    }
}
