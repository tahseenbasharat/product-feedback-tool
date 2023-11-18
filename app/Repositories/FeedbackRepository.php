<?php

namespace App\Repositories;

use App\Interfaces\FeedbackRepositoryInterface;
use App\Models\Feedback;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class FeedbackRepository implements FeedbackRepositoryInterface
{
    protected $feedback;

    public function __construct()
    {
        $this->feedback = Feedback::query();
    }

    public function index(): LengthAwarePaginator
    {
        return $this->feedback
            ->select('id', 'user_id', 'title', 'category', 'created_at')
            ->with([
                'author' =>
                    fn($q) => $q->select('id', 'name')
            ])
            ->withCount(['upVotes', 'downVotes'])
            ->paginate();
    }

    public function create(array $data): Model
    {
        return $this->feedback->create($data);
    }
}
