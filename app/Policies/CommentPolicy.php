<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user cam update the post instance.
     *
     * @param  \App\Models\User     $user
     * @param  \App\Models\Comment  $comment
     * @return bool
     */
    public function update(User $user, Comment $comment)
    {
        return ($user->id === $comment->user->id);
    }
}
