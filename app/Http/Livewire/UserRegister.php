<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Livewire\Component;

class UserRegister extends Component
{
    public $email;
    public $uname;
    public $fname;
    public $lname;
    public $password;
    public $password_confirmation;

    // protected $rules = [
    //     'email' => 'required|email|unique:users,email',
    //     'fname' => 'required|min:2|alpha',
    //     'lname' => 'required|min:2|alpha',
    //     'uname' => 'required|min:4|unique:users,uname|alpha_dash',
    //     'password' => ['required', 'confirmed', Password::min(8)->mixedCase()],
    // ];

    public function render()
    {
        return view('livewire.user-register');
    }

    public function register()
    {
        $this->validate([
            'email' => 'required|email|unique:users,email',
            'fname' => 'required|min:2|alpha',
            'lname' => 'required|min:2|alpha',
            'uname' => 'required|min:4|unique:users,uname|alpha_dash',
            'password' => ['required', 'confirmed', Password::min(8)->mixedCase()],
        ]);

        $newUser = User::create([
            'email' => $this->email,
            'uname' => $this->uname,
            'fname' => $this->fname,
            'lname' => $this->lname,
            'name' => $this->fname .' '. $this->lname,
            'password' => Hash::make($this->password),
        ]);

        auth()->login($newUser);

        return redirect()->route('feed');
    }
}
