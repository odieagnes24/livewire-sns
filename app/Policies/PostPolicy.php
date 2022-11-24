<?php

namespace App\Policies;

use App\Models\User;
use App\Models\UserPost;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function access(User $user, UserPost $post)
    {
        return $user->id === $post->user_id;
    }

    public function update(User $user, UserPost $post)
    {
        return $user->id === $post->user_id;
    }

    public function deletePost(User $user, UserPost $post)
    {
        return $user->id === $post->user_id;
    }
}
