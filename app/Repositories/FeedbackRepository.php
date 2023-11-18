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

    public function find(int $id)
    {
        return $this->feedback->find($id);
    }

    public function vote(array $data): bool
    {
        $feedback = $this->feedback
            ->with([
                'votes' =>
                    fn($q) => $q->whereUserId($data['user_id'])
            ])
            ->find($data['feedback_id']);

        if ($feedback->votes->count()) {
            $vote = $feedback
                ->votes
                ->where('feedback_id', $data['feedback_id'])
                ->first();
            if ($vote->type === $data['type']) {
                // delete existing vote
                $vote->delete();
            } else {
                // switch vote
                $vote->update([
                    'type' => $data['type']
                ]);
            }
        } else {
            // create new vote
            $feedback->votes()
                ->create($data);
        }

        return true;
    }
}
