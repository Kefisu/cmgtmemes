<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Tag;
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
        if(!$request->user()->authorizeRoles('admin')) {
            return redirect(url('/user'));
        }
        $posts = Post::orderBy('id', 'desc')->paginate(10);

        $data = [
            'posts' => $posts,
            'title' => 'Dashboard',
            'admin' => 1
        ];

        return view('dashboard.admin.index')->with($data);
    }

}
