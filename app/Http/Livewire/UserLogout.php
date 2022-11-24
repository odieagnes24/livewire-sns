<?php

namespace App\Http\Livewire;

use Livewire\Component;

class UserLogout extends Component
{
    public $is_mobile_view;

    public function mount($is_mobile_view = false)
    {
        $this->is_mobile_view = $is_mobile_view;
    }

    public function render()
    {
        return view('livewire.user-logout');
    }

    public function logout()
    {
        auth()->logout();

        return redirect()->route('login');
    }
}
