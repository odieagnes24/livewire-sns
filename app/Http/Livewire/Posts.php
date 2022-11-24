<?php

namespace App\Http\Livewire;

use App\Models\UserPost;
use Livewire\Component;
use Livewire\WithPagination;

class Posts extends Component
{
    use WithPagination;

    // protected $listeners = ['postAdded' => 'render'];

    // protected $paginationTheme = 'bootstrap';

    public $post;

    public function mount($post)
    {
        $this->post = $post;
    }

    public function render()
    {   
        // return view('livewire.posts', [
        //     'posts' => UserPost::with('user_like')->withCount(['likes', 'dislikes'])->orderByDesc('created_at')->paginate(5)
        // ]);
        return view('livewire.posts');
    }
    
    public function up(UserPost $post)
    {
       if(empty($post->user_like))
       {
            auth()->user()->likes()->create([
                'type' => 'liked',
                'user_post_id' => $post->id
            ]);
       }
       else
       {
           
            if($post->user_like->type == 'disliked')
            {
                auth()->user()->likes()->where('user_post_id', $post->id)->delete();
                auth()->user()->likes()->create([
                    'type' => 'liked',
                    'user_post_id' => $post->id
                ]);
            }
            else
            {
                auth()->user()->likes()->where('user_post_id', $post->id)->delete();
            }
       }
    }

    public function down(UserPost $post)
    {
        if(empty($post->user_like))
        {
             auth()->user()->likes()->create([
                 'type' => 'disliked',
                 'user_post_id' => $post->id
             ]);
        }
        else
        {
            if($post->user_like->type == 'liked')
            {
                auth()->user()->likes()->where('user_post_id', $post->id)->delete();
                auth()->user()->likes()->create([
                    'type' => 'disliked',
                    'user_post_id' => $post->id
                ]);
            }
            else
            {
                auth()->user()->likes()->where('user_post_id', $post->id)->delete();
            }
        }
    }
}
