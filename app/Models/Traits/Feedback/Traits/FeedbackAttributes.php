<?php

namespace App\Models\Traits\Feedback\Traits;

use App\Enums\FeedbackCategoryEnum;
use App\Enums\VoteTypeEnum;
use App\Models\Vote;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Auth;

trait FeedbackAttributes
{
    /**
     * Converting feedback category enum value to be readable
     *
     * @return Attribute
     */
    protected function category(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => ucwords(str_replace('-', ' ', $value)),
        );
    }

    /**
     * Append CSS class for appropriate feedback category value
     *
     * @return Attribute
     */
    protected function categoryClass(): Attribute
    {
        $category = $this->attributes['category'];
        return Attribute::make(
            get: fn() => match ($category) {
                FeedbackCategoryEnum::BugReport->value => 'badge-danger',
                FeedbackCategoryEnum::FeatureRequest->value => 'badge-info',
                FeedbackCategoryEnum::Improvement->value => 'badge-success',
                default => 'badge-secondary',
            },
        );
    }

    /**
     * Check whether authorized user submitted up vote
     *
     * @return Attribute
     */
    protected function upVoted(): Attribute
    {
        return Attribute::make(
            get: fn() => Vote::whereUserId(Auth::user()->id ?? null)
                ->whereFeedbackId($this->attributes['id'])
                ->whereType(VoteTypeEnum::UpVote)
                ->exists(),
        );
    }

    /**
     * Check whether authorized user submitted down vote
     *
     * @return Attribute
     */
    protected function downVoted(): Attribute
    {
        return Attribute::make(
            get: fn() => Vote::whereUserId(Auth::user()->id ?? null)
                ->whereFeedbackId($this->attributes['id'])
                ->whereType(VoteTypeEnum::DownVote)
                ->exists(),
        );
    }
}
