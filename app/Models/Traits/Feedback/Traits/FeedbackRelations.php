<?php

namespace App\Models\Traits\Feedback\Traits;

use App\Enums\VoteTypeEnum;
use App\Models\Comment;
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
     * One feedback may have many comments
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * One feedback may have many down_votes
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function downVotes()
    {
        return $this->hasMany(Vote::class)
            ->whereType(VoteTypeEnum::DownVote);
    }

    /**
     * One feedback may have many up_votes
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function upVotes()
    {
        return $this->hasMany(Vote::class)
            ->whereType( VoteTypeEnum::UpVote);
    }

    /**
     * One feedback may have many votes
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
}
