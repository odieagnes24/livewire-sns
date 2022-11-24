<?php

namespace App\Http\Livewire;

use App\Events\UserComment;
use App\Models\UserPost;
use Livewire\Component;

class CreateComment extends Component
{
    public $post;
    public $comments;

    public function mount(UserPost $post)
    {
        $this->post = $post;
    }

    protected $rules = [
        'comments' => 'required',
    ];

    public function render()
    {
        return view('livewire.create-comment');
    }

    public function create()
    {
        $validatedData = $this->validate();
        $new_comment = auth()->user()->comments()->create([
            'user_post_id' => $this->post->id,
            'contents' => $this->comments,
        ]);
        $this->comments = null;

        broadcast(new UserComment($new_comment))->toOthers();

        $this->emitUp('commentCreated');
    }
}
