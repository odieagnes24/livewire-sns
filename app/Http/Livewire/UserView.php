<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class UserView extends Component
{
    public $user;
    public $posts;
    public $all_count;
    public $followers_count;
    public $followings_count;

    public function mount(User $user)
    {   
        if(auth()->user()->id == $user->id)
        {
            return redirect()->route('profile');
        }

        $this->user = $user;

        $is_followed = auth()->user()->followings()->wherePivot('followed_id', $this->user->id)->get()->pluck('id')->toArray();

        $this->posts = $user->posts()
                            ->with(['user_like', 'user'])
                            ->withCount(['likes', 'dislikes', 'comments'])
                            ->where(function($query) use ($is_followed){
                                $query->where('visibility', 'Public')
                                    ->orWhere('user_id', $is_followed);
                            })
                            ->latest()
                            ->take(8)
                            ->get();

        $this->followers_count = $user->followers()->count();
        $this->followings_count = $user->followings()->count();
        $this->all_count = $user->posts()->count();
    }

    public function hydrate()
    {
        $this->all_count = $this->user->posts()->count();
    }

    public function render()
    {
        return view('livewire.user-view');
    }

    public function loadPosts()
    {
        $is_followed = auth()->user()->followings()->wherePivot('followed_id', $this->user->id)->get()->pluck('id')->toArray();
        $get_posts = $this->user->posts()->whereNotIn('id', $this->posts->pluck('id')->toArray())
                                ->with(['user_like', 'user', 'user_saved'])
                                ->where(function($query) use ($is_followed){
                                    $query->where('visibility', 'Public')
                                        ->orWhere('user_id', $is_followed);
                                })
                                ->withCount(['likes', 'dislikes', 'comments'])
                                ->latest()
                                ->take(8)
                                ->get();
        $this->posts = $this->posts->concat($get_posts);
    }
}
