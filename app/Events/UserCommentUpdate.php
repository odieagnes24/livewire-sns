<?php

namespace App\Events;

use App\Models\UserComment;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserCommentUpdate implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $comment_id;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($comment_id)
    {
        $this->comment_id = $comment_id;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('post-comment.' . $this->comment_id);
    }

    public function broadcastWith()
    {
        return [
            'purpose' => 'update',
        ];
    }
}
