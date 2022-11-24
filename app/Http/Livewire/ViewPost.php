<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\UserPost;
use Livewire\Component;

class ViewPost extends Component
{
    public $post;

    public function mount(UserPost $post)
    {
        $this->post = $post;
    }

    public function render()
    {
        return view('livewire.view-post');
    }
}
