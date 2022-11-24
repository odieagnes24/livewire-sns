<?php

namespace App\Http\Controllers;

use App\Events\UserUpdate;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function follow(User $user)
    {
        $follow = $user->followers()->toggle(auth()->user()->id);       

        if(!empty($follow['attached']))
        {
            broadcast(new UserUpdate($user, ['type' => 'user_follow', 'optional_id' => auth()->user()->id, 'from_user' => auth()->user()->id, 'contents' => auth()->user()->name . ' followed you.']));
        }
      
        return true;
    }
}
