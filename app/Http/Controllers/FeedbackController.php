<?php

namespace App\Http\Controllers;

use App\Http\Requests\Feedback\StoreFeedbackRequest;
use App\Http\Requests\Feedback\SubmitCommentRequest;
use App\Http\Requests\Feedback\SubmitVoteFeedbackRequest;
use App\Interfaces\Repositories\FeedbackRepositoryInterface;
use App\Models\Feedback;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class FeedbackController extends Controller
{
    private FeedbackRepositoryInterface $feedbackRepository;

    /**
     * Injecting FeedbackRepositoryInterface
     *
     * @param FeedbackRepositoryInterface $feedbackRepository
     */
    public function __construct(FeedbackRepositoryInterface $feedbackRepository)
    {
        $this->feedbackRepository = $feedbackRepository;
    }

    /**
     * Add new comment on feedback
     *
     * @param SubmitCommentRequest $request
     * @return RedirectResponse
     */
    public function comment(SubmitCommentRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['user_id'] = $request->user()->id;

        $this->feedbackRepository->storeComment($data);

        Session::flash('alert-success', 'Comment submitted successfully');

        return redirect()
            ->back();
    }

    /**
     * Return form page to add new feedback
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create(): View
    {
        return view('feedback.create');
    }

    /**
     * Delete feedback record from database
     *
     * @param Feedback $feedback
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Feedback $feedback): RedirectResponse
    {
        $deleted = $this->feedbackRepository->destroy($feedback);

        $r = match ($deleted) {
            TRUE => [
                'alertType' => 'alert-success',
                'message' => 'Record deleted successfully',
            ],
            FALSE => [
                'alertType' => 'alert-danger',
                'message' => 'Something went wrong deleting the record'
            ]
        };

        Session::flash($r['alertType'], $r['message']);

        return redirect()
            ->back();
    }

    /**
     * Return listing page for feedback
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(): View
    {
        $data = $this->feedbackRepository->paginatedList();

        return view('feedback.index')
            ->with([
                'data' => $data
            ]);
    }

    /**
     * Return detail page for feedback
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show(int $id): View
    {
        $feedback = $this->feedbackRepository->find($id);
        $comments = $this->feedbackRepository->paginatedCommentListByFeedbackId($id);

        return view('feedback.show')
            ->with([
                'feedback' => $feedback,
                'comments' => $comments,
            ]);
    }

    /**
     * Validate the form data,
     * Store the form submitted data for new feedback,
     * & Redirect to feedback listing page
     *
     * @param StoreFeedbackRequest $request
     * @return RedirectResponse
     */
    public function store(StoreFeedbackRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['user_id'] = $request->user()->id;

        $this->feedbackRepository->store($data);

        Session::flash('alert-success', 'Feedback created successfully');

        return redirect()
            ->route('feedback.index');
    }

    /**
     * Submit feedback vote i.e. upvote / downvote
     *
     * @param SubmitVoteFeedbackRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function vote(SubmitVoteFeedbackRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['user_id'] = $request->user()->id;

        $res = $this->feedbackRepository->storeVote($data);

        Session::flash('alert-success', $res ? 'Vote submitted successfully' : 'Vote removed');

        return redirect()
            ->back();
    }

    /**
     * Enable / disable comments on feedback
     *
     * @param Feedback $feedback
     * @return RedirectResponse
     */
    public function toggleComment(Feedback $feedback): RedirectResponse
    {
        $updated = $this->feedbackRepository->toggleComments($feedback);

        $r = match ($updated) {
            TRUE => [
                'alertType' => 'alert-success',
                'message' => $feedback->is_comment_enabled ?
                    "Comments disabled for $feedback->id" : "Comments enabled for $feedback->id",
            ],
            FALSE => [
                'alertType' => 'alert-danger',
                'message' => 'Something went wrong deleting the record'
            ]
        };

        Session::flash($r['alertType'], $r['message']);

        return redirect()
            ->back();
    }
}
