<?php

namespace App\Models;

use App\Models\Traits\Comment\CommentRelations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory, CommentRelations;

    /**
     * Default page size for pagination
     *
     * @var int
     */
    protected $perPage = 5;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'content',
        'feedback_id',
        'user_id',
    ];
}
