<?php

namespace App\Events;

use App\Models\UserLike as ModelsUserLike;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserLike implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $like;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(ModelsUserLike $like)
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
        return new PrivateChannel('user-post.' . $this->like->post->id);
    }

    public function broadcastWith()
    {
        return [
            'purpose' => 'like',
            'user' => [
                'name' => $this->like->user->name
            ],
        ];
    }
}
