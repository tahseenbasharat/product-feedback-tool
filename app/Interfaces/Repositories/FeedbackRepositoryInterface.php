<?php

namespace App\Interfaces\Repositories;

use App\Interfaces\Repositories\Base\DestroyInterface;
use App\Interfaces\Repositories\Base\FindInterface;
use App\Interfaces\Repositories\Base\PaginateInterface;
use App\Interfaces\Repositories\Base\StoreInterface;
use App\Models\Feedback;
use Illuminate\Pagination\LengthAwarePaginator;

interface FeedbackRepositoryInterface extends DestroyInterface, FindInterface, PaginateInterface, StoreInterface
{
    /**
     * return LengthAwarePaginator<Comment> results for given feedback id
     *
     * @param int $feedbackId
     * @return LengthAwarePaginator
     */
    public function paginatedCommentListByFeedbackId(int $feedbackId): LengthAwarePaginator;

    /**
     * create new vote entry into database records
     * return true when vote create / update
     * return false when vote deleted / removed
     *
     * @param array $data
     * @return bool
     */
    public function storeVote(array $data): bool;

    /**
     * create new comment entry into database records
     * return true when comment created successfully
     *
     * @param array $data
     * @return bool
     */
    public function storeComment(array $data): bool;

    public function toggleComments(Feedback $feedback): bool;
}
