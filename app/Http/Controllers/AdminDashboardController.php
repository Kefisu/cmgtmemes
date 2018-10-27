<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Tag;
use App\User;
use Illuminate\Support\Facades\Auth;


class AdminDashboardController extends Controller
{
    public function __construct(Request $request)
    {
        $this->middleware('auth');
    }


    public function index(Request $request)
    {
        // Check if user is admin
        if (!$request->user()->authorizeRoles('admin')) {
            return redirect(url('/user'));
        }

        $data = [
            'posts' => Post::orderBy('id', 'desc')->paginate(10),
            'users' => User::paginate(10),
            'title' => 'Dashboard',
            'admin' => 1
        ];

        return view('dashboard.admin.index')->with($data);
    }

    public function analytics(Request $request)
    {
        // Check if user is admin
        if (!$request->user()->authorizeRoles('admin')) {
            return redirect(url('/user'));
        }

        $data = [
            'title' => 'Analytics',
            'admin' => '1'
        ];

        return view('dashboard.admin.analytics')->with($data);
    }

    public function featured(Request $request, $id)
    {
        $featured = $request->input('featured');
        $post = Post::find($id);
        if (isset($featured)) {
            // Feature meme
            $post->featured = 1;
            $post->save();

            return redirect('/admin')->with('success', 'This meme is now featured');
        } else {
            // Unfeature meme
            $post->featured = 0;
            $post->save();

            return redirect('/admin')->with('warning', 'This meme is not featured anymore');
        }
    }

}
