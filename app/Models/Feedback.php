<?php

namespace App\Models;

use App\Enums\FeedbackCategoryEnum;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    /**
     * Default page size for pagination
     *
     * @var int
     */
    protected $perPage = 25;

    protected $appends = [
        'category_class',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'category',
        'description',
        'user_id',
    ];

    /**
     * Define the belongsTo relationship with User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

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
