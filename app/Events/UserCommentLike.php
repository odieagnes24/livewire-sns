<?php

namespace App\Events;

use App\Models\UserCommentLike as ModelsUserCommentLike;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserCommentLike implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $like;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(ModelsUserCommentLike $like)
    {
        $this->like = $like;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('post-comment.' . $this->like->user_comment_id);
    }

    public function broadcastWith()
    {
        return [
            'purpose' => 'like',
            'user' => [
                'name' => $this->like->user->name
            ]
        ];
    }
}
