<?php

namespace App\http;

use App\Rating;
use Illuminate\Support\Facades\Auth;
use App\User;

class Helpers
{
    public static function checkUserStatus()
    {
        $user = User::find(Auth::user()->id);
        if ($user->unlocked == null || $user->unlocked == 0) :
            if (Rating::where('user_id', Auth::user()->id)->count() >= 5) :
                $user->unlocked = 1;
                $user->save();
                // User has made 5 or more
                return true;
            else:
                // User has not made 5 or more
                return false;
            endif;
        else:
            // User is already validated
            return true;
        endif;
    }

}
