<?php

namespace App\Http\Livewire;

use App\Events\PostUpdate;
use App\Events\UserLike;
use App\Events\UserUpdate;
use App\Models\UserPost;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Post extends Component
{
    use AuthorizesRequests;

    public $post;
    public $showComments = false;
    public $comments;
    // public $comment_count = 0;
    public $paginate_comments = 6;
    public $is_view;
   
    public function getListeners()
    {
        return [
            'commentCreated' => '$refresh', 
            'commentCreated' => 'newComment',
            'echo-private:user-post.'. $this->post->id . ',PostUpdate' => 'fireEventFromBroadcast',
            'echo-private:user-post.'. $this->post->id . ',UserLike' => 'fireEventFromBroadcast',
            'echo-private:user-post.'. $this->post->id . ',UserComment' => 'fireEventFromBroadcast',
        ];
    }

    public function mount(UserPost $post, $is_view = true)
    {
        $this->is_view = $is_view;
        $this->post = $post;

        if($this->is_view)
        {
            $this->showComments = true;
            $this->hydrate();
            $this->fetchComments();
        }
    }

    public function hydrate()
    {
        $this->post = $this->post->load(['user_like', 'user_saved'])->loadCount(['likes', 'dislikes', 'comments']);
        // $this->comment_count = $this->post->comments_count;
    }

    public function fireEventFromBroadcast($data)
    {   
        if($data['purpose'] == 'update')
        {
            return;
        }
        elseif($data['purpose'] == 'new_comment')
        {
            if($this->showComments)
            {
                $this->fetchComments();
            }
        }
    }
  
    public function notifyComment()
    {
        $this->hydrate();
        if($this->showComments)
        {
            $this->fetchComments();
        }
    }

    public function render()
    {
        return view('livewire.post');
    }

    public function up()
    {
        if(empty($this->post->user_like))
        {
            $user_like = auth()->user()->likes()->create([
                    'type' => 'liked',
                    'user_post_id' => $this->post->id
                ]);
            broadcast(new UserLike($user_like))->toOthers();
            if(auth()->user()->cannot('access', $this->post))
            {
                broadcast(new UserUpdate($this->post->user, ['type' => 'post_like', 'optional_id' => $this->post->id, 'from_user' => $user_like->user->name, 'contents' => $user_like->user->name . ' liked your post']));
            }
        }
        else
        {   
            if($this->post->user_like->type == 'disliked')
            {
                auth()->user()->likes()->where('user_post_id', $this->post->id)->delete();
                $user_like = auth()->user()->likes()->create([
                    'type' => 'liked',
                    'user_post_id' => $this->post->id
                ]);
                broadcast(new UserLike($user_like))->toOthers();
                if(auth()->user()->cannot('access', $this->post))
                {
                    broadcast(new UserUpdate($this->post->user, ['type' => 'post_like', 'optional_id' => $this->post->id, 'from_user' => $user_like->user->name, 'contents' => $user_like->user->name . ' liked your post']));
                }
            }
            else
            {
                auth()->user()->likes()->where('user_post_id', $this->post->id)->delete();
                broadcast(new PostUpdate($this->post->id))->toOthers();
            }
        }
        
        $this->hydrate();
    }

    public function down()
    {
        if(empty($this->post->user_like))
        {
            $user_like = auth()->user()->likes()->create([
                'type' => 'disliked',
                'user_post_id' => $this->post->id
            ]);

            broadcast(new UserLike($user_like))->toOthers();
            if(auth()->user()->cannot('access', $this->post))
            {
                broadcast(new UserUpdate($this->post->user, ['type' => 'post_dislike', 'optional_id' => $this->post->id, 'from_user' => $user_like->user->name, 'contents' => $user_like->user->name . ' disliked your post']));
            }
        }
        else
        {
            if($this->post->user_like->type == 'liked')
            {
                auth()->user()->likes()->where('user_post_id', $this->post->id)->delete();
                $user_like = auth()->user()->likes()->create([
                    'type' => 'disliked',
                    'user_post_id' => $this->post->id
                ]);
                broadcast(new UserLike($user_like));
                if(auth()->user()->cannot('access', $this->post))
                {
                    broadcast(new UserUpdate($this->post->user, ['type' => 'post_dislike', 'optional_id' => $this->post->id, 'from_user' => $user_like->user->name, 'contents' => $user_like->user->name . ' disliked your post']));
                }
            }
            else
            {
                auth()->user()->likes()->where('user_post_id', $this->post->id)->delete();
                broadcast(new PostUpdate($this->post->id))->toOthers();
            }
        }
       
        $this->hydrate();
    }

    public function setVisibility($visibility)
    {
        $this->authorize('update', $this->post);
        $this->post->visibility = $visibility;
        $this->post->save();
        $this->hydrate();
    }

    public function delete()
    {
        $save_temp_id = $this->post->id;
        $this->authorize('deletePost', $this->post);
        $this->post->delete();
        $this->emit('postDeleted', $save_temp_id);
    }

    public function savePost()
    {
        $get = auth()->user()->save_posts()->where('user_post_id', $this->post->id)->first();
        // dd($get);
        if(empty($get))
        {
            auth()->user()->save_posts()->create([
                'user_post_id' => $this->post->id
            ]);

            $this->dispatchBrowserEvent('post-saved', ['contents' => 'Post successfully saved!']);
        }
        else
        {
            auth()->user()->save_posts()->where('user_post_id', $this->post->id)->first()->delete();
            $this->dispatchBrowserEvent('post-saved', ['contents' => 'Post successfully removed to save posts!']);
            $this->emit('unsaved');
        }
        $this->hydrate();

    }

    public function loadMoreComments()
    {
        $this->paginate_comments += 6;
        $this->fetchComments();
    }

    public function newComment()
    {
        $this->paginate_comments += 1;
        $this->fetchComments();
    }

    public function fetchComments()
    {   
        $this->showComments = true;
        $this->comments = $this->post->comments->load(['user', 'user_like'])->loadCount(['likes', 'dislikes'])->sortByDesc('created_at')->forPage(1, $this->paginate_comments);
    }
}
