<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Livewire\Component;

class UserSettings extends Component
{
    public $fname;
    public $lname;
    public $uname;
    public $email;
    public $password;
    public $password_confirmation;
    // public $email;

    public function mount()
    {
       $this->setValues();
    }

    public function setValues()
    {
        $this->fname = auth()->user()->fname;
        $this->lname = auth()->user()->lname;
        $this->uname = auth()->user()->uname;
        $this->email = auth()->user()->email;
    }

    public function render()
    {
        return view('livewire.user-settings');
    }

    public function updateInfo()
    {
        $this->validate([
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore(auth()->user()->id)
            ],
            'fname' => 'required|min:2',
            'lname' => 'required|min:2',
            'uname' => [
                'required',
                'min:4',
                'alpha_dash',
                Rule::unique('users')->ignore(auth()->user()->id)
            ],
        ]);

        $user = auth()->user();
        $user->fname = $this->fname;
        $user->lname = $this->lname;
        $user->name = $this->fname .' '. $this->lname;
        $user->uname = $this->uname;
        $user->email = $this->email;
        $user->save();

        $this->setValues();

        $this->dispatchBrowserEvent('account-updated', ['contents' => 'Account info has been updated!', 'uname' => auth()->user()->uname]);
    }

    public function updatePassword()
    {
        $this->validate([
            'password' => ['required', 'confirmed', Password::min(8)->mixedCase()],
        ]);

        auth()->user()->update([
            'password' => Hash::make($this->password)
        ]);
        // $user->password =;
        // $user->saved();

        $this->password = '';
        $this->password_confirmation = '';

        $this->dispatchBrowserEvent('password-updated', ['contents' => 'Account password has been updated!']);
    }
}
