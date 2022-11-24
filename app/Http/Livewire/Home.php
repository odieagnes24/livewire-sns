<?php

namespace App\Http\Livewire;

use App\Models\UserPost;
use Illuminate\Support\Facades\Route;
use Livewire\Component;
use Livewire\WithPagination;

class Home extends Component
{
    // use WithPagination;

    public $paginate_items = 6;
    // protected $paginationTheme = 'bootstrap';
    public $posts;
    public $all_count;

    // protected $listeners = ['postCreated' => 'newPost', 'postDeleted' => 'render'];
    public function mount()
    {
        $this->loadPosts(8);
        $this->all_count = UserPost::count();
    }

    public function hydrate()
    {
        $this->all_count = UserPost::count();
        // dd($this->all_count);
    }

    public function getListeners()
    {
        return [
            'postCreated', 
            'postDeleted',
            // 'echo-private:user-home,PostCreated' => 'loadPosts',
        ];
    }

    public function postCreated(UserPost $post)
    {
        $this->posts = $this->posts->prepend($post->load(['user_like', 'user'])->loadCount(['likes', 'dislikes', 'comments']));
    }

    public function postDeleted($post_id)
    {
        $this->posts = $this->posts->filter(function($item) use ($post_id){
            return $item->id != $post_id;
        });
    }

    public function render()
    {
        return view('livewire.home');
    }

    public function loadPosts()
    {   
        // dd(Route::current()->getName());
        // dd(auth()->user()->followings()->get()->pluck('id')->toArray());
        $user_followers = auth()->user()->followings()->get()->pluck('id')->toArray();
        if(!empty($this->posts))
        {
            $get_posts = UserPost::whereNotIn('id', $this->posts->pluck('id')->toArray())
                                    ->with(['user_like', 'user', 'user_saved'])
                                    ->withCount(['likes', 'dislikes', 'comments'])
                                    ->where(function($query) use ($user_followers){
                                        $query->where('visibility', 'Public')
                                            ->orWhereIn('user_id', $user_followers);
                                    })
                                    ->latest()
                                    ->take(8)
                                    ->get();
            $this->posts = $this->posts->concat($get_posts);
        }
        else
        {
            if(Route::current()->getName() == 'feed')
            {
                $this->posts = UserPost::with(['user_like', 'user', 'user_saved'])
                                        ->withCount(['likes', 'dislikes', 'comments'])
                                        ->where(function($query) use ($user_followers){
                                            $query->where('visibility', 'Public')
                                                ->orWhereIn('user_id', $user_followers);
                                        })
                                        ->orderBy('comments_count', 'desc')
                                        ->take(8)
                                        ->get();
            }
            else if(Route::current()->getName() == 'random')
            {
                $this->posts = UserPost::with(['user_like', 'user', 'user_saved'])
                                        ->withCount(['likes', 'dislikes', 'comments'])
                                        ->where(function($query) use ($user_followers){
                                            $query->where('visibility', 'Public')
                                                ->orWhereIn('user_id', $user_followers);
                                        })
                                        ->inRandomOrder()
                                        ->take(8)
                                        ->get();
            }
            else if(Route::current()->getName() == 'top')
            {
                $this->posts = UserPost::with(['user_like', 'user', 'user_saved'])
                                        ->withCount(['likes', 'dislikes', 'comments'])
                                        ->where(function($query) use ($user_followers){
                                            $query->where('visibility', 'Public')
                                                ->orWhereIn('user_id', $user_followers);
                                        })
                                        ->orderBy('likes_count', 'desc')
                                        ->take(8)
                                        ->get();
            }
            else
            {
                $this->posts = UserPost::with(['user_like', 'user', 'user_saved'])
                                        ->withCount(['likes', 'dislikes', 'comments'])
                                        ->where(function($query) use ($user_followers){
                                            $query->where('visibility', 'Public')
                                                ->orWhereIn('user_id', $user_followers);
                                        })
                                        ->latest()
                                        ->take(8)
                                        ->get();
            }
            
        }
    }

}
