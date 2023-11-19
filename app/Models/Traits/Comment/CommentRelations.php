<?php

namespace App\Models\Traits\Comment;

use App\Models\User;

trait CommentRelations
{
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
