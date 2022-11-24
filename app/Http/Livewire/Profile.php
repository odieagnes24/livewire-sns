<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Profile extends Component
{
    public $posts;
    public $all_count;
    public $followers_count;
    public $followings_count;

    public function mount()
    {
        $this->posts = auth()->user()->posts()->with(['user_like', 'user'])->withCount(['likes', 'dislikes', 'comments'])->latest()->take(8)->get();
        $this->followers_count = auth()->user()->followers()->count();
        $this->followings_count = auth()->user()->followings()->count();
        $this->all_count = auth()->user()->posts()->count();
    }

    public function hydrate()
    {
        $this->all_count = auth()->user()->posts()->count();
    }

    public function render()
    {
        return view('livewire.profile');
    }

    public function loadPosts()
    {
        $get_posts = auth()->user()->posts()->whereNotIn('id', $this->posts->pluck('id')->toArray())
                                ->with(['user_like', 'user', 'user_saved'])
                                ->withCount(['likes', 'dislikes', 'comments'])
                                ->latest()
                                ->take(8)
                                ->get();
        $this->posts = $this->posts->concat($get_posts);
    }
}
