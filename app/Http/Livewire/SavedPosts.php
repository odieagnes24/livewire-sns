<?php

namespace App\Http\Livewire;

use App\Models\UserPost;
use Livewire\Component;

class SavedPosts extends Component
{
    // public $paginate_items = 6;
    public $posts;
    public $all_count;

    public function mount()
    {
        $this->loadPosts(8);
        $this->all_count = auth()->user()->save_posts()->count();
    }

    public function hydrate()
    {
        $this->all_count = auth()->user()->save_posts()->count();
    }

    public function getListeners()
    {
        return [
            'postCreated', 
            'postDeleted',
            'unsaved' => '$refresh'
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
        return view('livewire.saved-posts');
    }

    public function loadPosts()
    {   
        if(!empty($this->posts))
        {
            $get_posts = auth()->user()->save_posts()
                                        ->whereNotIn('id', $this->posts->pluck('id')->toArray())
                                        ->with(['post' => function($q){
                                            $q->with(['user_like', 'user', 'user_saved'])
                                                ->withCount(['likes', 'dislikes', 'comments']);
                                        }])
                                        ->orderBy('created_at', 'desc')
                                        ->take(8)
                                        ->get();

                               
            $this->posts = $this->posts->concat($get_posts);
        }
        else
        {   
            $this->posts = auth()->user()->save_posts()
                                        ->with(['post' => function($q){
                                            $q->with(['user_like', 'user', 'user_saved'])
                                                ->withCount(['likes', 'dislikes', 'comments']);
                                        }])
                                        ->orderBy('created_at', 'desc')
                                        ->take(8)
                                        ->get();
        }
    }
}
