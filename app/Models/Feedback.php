<?php

namespace App\Models;

use App\Enums\FeedbackCategoryEnum;
use App\Models\Traits\Feedback\Traits\FeedbackAttributes;
use App\Models\Traits\Feedback\Traits\FeedbackRelations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory, FeedbackAttributes, FeedbackRelations;

    /**
     * Default page size for pagination
     *
     * @var int
     */
    protected $perPage = 25;

    protected $appends = [
        'category_class',
        'down_voted',
        'up_voted',
    ];

    protected $casts = [
        'category' => FeedbackCategoryEnum::class
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
}
