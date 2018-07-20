<?php

namespace Sanmark\EuphemeLaravelSdk;

use App\User;
use Illuminate\Support\Facades\Auth;

class UserHelper implements iUserHelper
{

    public function getAuthUserID()
    {
        $user = Auth::user();
        if ($user){
            return $user->id;
        }
        return null;
    }

    public function getUserNameFromID($userID)
    {
        $user = User::find($userID);

        if ($user){
            return $user->name;
        }

        return "Anonymous";
    }
}