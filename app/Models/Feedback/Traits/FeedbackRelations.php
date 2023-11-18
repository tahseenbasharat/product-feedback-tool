<?php

namespace App\Models\Feedback\Traits;

use App\Models\User\User;

trait FeedbackRelations
{
    /**
     * Define the belongsTo relationship with User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
