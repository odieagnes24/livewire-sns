<?php

namespace App\Http\Livewire;

use App\Events\UserCommentLike;
use App\Events\UserCommentUpdate;
use App\Models\UserComment;
use Livewire\Component;

class Comment extends Component
{
    public $comment;

    public function getListeners()
    {
        return [
            'echo-private:post-comment.'. $this->comment->id . ',UserCommentUpdate' => 'fireEventFromBroadcast',
            'echo-private:post-comment.'. $this->comment->id . ',UserCommentLike' => 'fireEventFromBroadcast',
        ];
    }

    public function mount(UserComment $comment)
    {
        $this->comment = $comment;
    }

    public function render()
    {
        return view('livewire.comment');
    }

    public function refreshMe()
    {
        $this->comment->load('user_like')->loadCount(['likes', 'dislikes']);
    }
    
    public function fireEventFromBroadcast($data)
    {
        if($data['purpose'] == 'update')
        {
          $this->refreshMe();
        }
        elseif($data['purpose'] == 'like')
        {
            $this->refreshMe();
        }
    }

    public function up()
    {
        if(empty($this->comment->user_like))
        {
            $like = auth()->user()->commment_likes()->create([
                'type' => 'liked',
                'user_comment_id' => $this->comment->id
            ]);
            broadcast(new UserCommentLike($like))->toOthers();
        }
        else
        {   
            if($this->comment->user_like->type == 'disliked')
            {
                auth()->user()->commment_likes()->where('user_comment_id', $this->comment->id)->delete();
                $like = auth()->user()->commment_likes()->create([
                    'type' => 'liked',
                    'user_comment_id' => $this->comment->id
                ]);
                broadcast(new UserCommentLike($like))->toOthers();
            }
            else
            {
                auth()->user()->commment_likes()->where('user_comment_id', $this->comment->id)->delete();
                broadcast(new UserCommentUpdate($this->comment->id))->toOthers();
            }
        }

     
        $this->refreshMe();
    }

    public function down()
    {
        if(empty($this->comment->user_like))
        {
            $like = auth()->user()->commment_likes()->create([
                'type' => 'disliked',
                'user_comment_id' => $this->comment->id
            ]);
            broadcast(new UserCommentLike($like))->toOthers();
        }
        else
        {
            if($this->comment->user_like->type == 'liked')
            {
                auth()->user()->commment_likes()->where('user_comment_id', $this->comment->id)->delete();
                $like = auth()->user()->commment_likes()->create([
                    'type' => 'disliked',
                    'user_comment_id' => $this->comment->id
                ]);
                broadcast(new UserCommentLike($like))->toOthers();
            }
            else
            {
                auth()->user()->commment_likes()->where('user_comment_id', $this->comment->id)->delete();
                broadcast(new UserCommentUpdate($this->comment->id))->toOthers();
            }
        }


        $this->refreshMe();
    }
}
