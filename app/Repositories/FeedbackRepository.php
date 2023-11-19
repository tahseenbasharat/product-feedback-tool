<?php

namespace App\Repositories;

use App\Interfaces\Repositories\FeedbackRepositoryInterface;
use App\Models\Comment;
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

    /**
     * Find Feedback by id
     *
     * @param int $id
     * @return Feedback|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|Model|null
     */
    public function find(int $id): Feedback
    {
        return $this->feedback
            ->with([
                'author' =>
                    fn($q) => $q->select('id', 'name'),
            ])
            ->withCount(['upVotes', 'downVotes'])
            ->findOrFail($id);
    }

    /**
     * return paginated <Comment> results for given feedback id
     *
     * @param int $feedbackId
     * @return LengthAwarePaginator
     */
    public function paginatedCommentListByFeedbackId(int $feedbackId): LengthAwarePaginator
    {
        return Comment::select('id', 'user_id', 'content', 'created_at')
            ->with([
                'author' => fn($q) => $q->select('id', 'name'),
            ])
            ->whereFeedbackId($feedbackId)
            ->orderBy('id', 'desc')
            ->paginate();
    }

    /**
     * return paginated <Feedback> results
     *
     * @return LengthAwarePaginator
     */
    public function paginatedList(): LengthAwarePaginator
    {
        return $this->feedback
            ->select('id', 'user_id', 'title', 'category', 'created_at')
            ->with([
                'author' =>
                    fn($q) => $q->select('id', 'name')
            ])
            ->withCount(['upVotes', 'downVotes'])
            ->orderBy('id', 'desc')
            ->paginate();
    }

    /**
     * Create new entry feedback entry into database records
     *
     * @param array $data
     * @return Feedback|\Illuminate\Database\Eloquent\Builder|Model
     */
    public function store(array $data): Feedback
    {
        return $this->feedback->create($data);
    }

    /**
     * create new comment entry into database records
     * return true when comment created successfully
     *
     * @param array $data
     * @return bool
     */
    public function storeComment(array $data): bool
    {
        Comment::create($data);

        return true;
    }

    /**
     * create new vote entry into database records
     * return true when vote create / update
     * return false when vote deleted / removed
     *
     * @param array $data
     * @return bool
     */
    public function storeVote(array $data): bool
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

                return false;
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
