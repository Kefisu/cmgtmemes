<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Tag;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Check if user is logged
        if (!$user = Auth::user()) {
            return redirect('/login')->with('warning', 'You need to be logged in to access this page');
        } else {
            // Check if user has correct role
            if ($request->user()->authorizeRoles('admin')) {
                // Check if user role is admin
                return redirect(url('/admin'));
            } elseif ($request->user()->authorizeRoles('user')) {
                // Check if user role is user
                return redirect(url('/user'));
            } else {
                // return error if not successful
                abort(403, 'Unauthorized action.');
            }
        }
    }

    // Admin dashboard functions

    public function admin(Request $request)
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

    // User dashboard funcions

    public function user()
    {
        $posts = Post::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->paginate(10);

        $data = [
            'posts' => $posts,
            'title' => 'Dashboard'
        ];

        return view('dashboard.user.index')->with($data);
    }

    // Shared functions

    public function account(Request $request)
    {
        $admin = 1;
        // Check if user is admin
        if (!$request->user()->authorizeRoles('admin')) {
            $admin = 0;
        }

        $data = [
            'title' => 'Account',
            'admin' => $admin
        ];

        return view('dashboard.account.index')->with($data);
    }
}
