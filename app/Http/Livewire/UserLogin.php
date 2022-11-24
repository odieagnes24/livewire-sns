<?php

namespace App\Http\Livewire;

use Livewire\Component;

class UserLogin extends Component
{
    public $email, $password, $remember;

    public function render()
    {
        return view('livewire.user-login');
    }

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required'
    ];


    public function login()
    {
        $validatedData = $this->validate();
     
        if(auth()->attempt($validatedData, $this->remember))
        {
            return redirect()->route('feed');
        }
        else
        {
            session()->flash('error_message', 'Invalid Credentials!');
        }
    }
}
