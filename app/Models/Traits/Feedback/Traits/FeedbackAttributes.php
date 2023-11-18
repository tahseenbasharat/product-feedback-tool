<?php

namespace App\Models\Traits\Feedback\Traits;

use App\Enums\FeedbackCategoryEnum;
use Illuminate\Database\Eloquent\Casts\Attribute;

trait FeedbackAttributes
{


    protected function category(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => ucwords(str_replace('-', ' ', $value)),
        );
    }

    protected function categoryClass(): Attribute
    {
        $category = $this->attributes['category'];
        return Attribute::make(
            get: fn() => match ($category) {
                FeedbackCategoryEnum::BugReport->value => 'badge-danger',
                FeedbackCategoryEnum::FeatureRequest->value => 'badge-info',
                FeedbackCategoryEnum::Improvement->value => 'badge-success',
            },
        );
    }
}
