<?php

namespace App\Models\Traits\Feedback\Traits;

use App\Enums\VoteTypeEnum;
use App\Models\User;
use App\Models\Vote;

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

    /**
     *
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function votes()
    {
        return $this->hasMany(Vote::class);
    }

    public function upVotes()
    {
        return $this->hasMany(Vote::class)
            ->where('type', VoteTypeEnum::UpVote);
    }

    public function downVotes()
    {
        return $this->hasMany(Vote::class)
            ->where('type', VoteTypeEnum::DownVote);
    }
}
