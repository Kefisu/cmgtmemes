<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
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
}
