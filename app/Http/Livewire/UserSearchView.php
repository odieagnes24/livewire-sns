<?php

namespace App\Http\Livewire;

use App\Http\Controllers\UserController;
use App\Models\User;
use Livewire\Component;

class UserSearchView extends Component
{
    public $user;

    public function mount(User $user)
    {   
        $this->user = $user->load('auth_user_followed')->loadCount(['posts', 'followers', 'followings']);
    }

    public function followUser()
    {   
        // dd($this->users);
        if(auth()->user()->id !== $this->user->id)
        {
            $user_controller = new UserController;
            $user_controller->follow($this->user);
        }

        $this->refreshMe();
    }

    public function refreshMe()
    {
        // dd($this->users->pluck('id')->toArray());
        $this->user = $this->user->load('auth_user_followed')->loadCount(['posts', 'followers', 'followings']);
    }

    public function render()
    {
        return view('livewire.user-search-view');
    }
}
