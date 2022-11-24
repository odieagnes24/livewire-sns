<?php

namespace App\Http\Livewire;

use App\Http\Controllers\UserController;
use App\Models\User;
use Livewire\Component;

class People extends Component
{
    public $users;

    public function mount()
    {
        $this->users = User::whereNotIn('id', [auth()->user()->id])->with(['auth_user_followed'])->take(10)->get();
    }

    public function render()
    {
        return view('livewire.people');
    }

    public function followUser(User $user)
    {   
        // dd($this->users);
        if(auth()->user()->id !== $user->id)
        {
            $user_controller = new UserController;
            $user_controller->follow($user);
        }

        $this->refreshMe();
    }

    public function refreshMe()
    {
        // dd($this->users->pluck('id')->toArray());
        $this->users = User::whereNotIn('id', [auth()->user()->id])->whereIn('id', $this->users->pluck('id')->toArray())->with(['auth_user_followed'])->get();
    }
}
