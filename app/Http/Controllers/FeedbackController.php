<?php

namespace App\Http\Controllers;

use App\Http\Requests\Feedback\StoreFeedbackRequest;
use App\Http\Requests\Feedback\SubmitVoteFeedbackRequest;
use App\Interfaces\FeedbackRepositoryInterface;
use Illuminate\Http\RedirectResponse;

class FeedbackController extends Controller
{
    private FeedbackRepositoryInterface $feedbackRepository;

    /**
     * @param FeedbackRepositoryInterface $feedbackRepository
     */
    public function __construct(FeedbackRepositoryInterface $feedbackRepository)
    {
        $this->feedbackRepository = $feedbackRepository;
    }

    /**
     * Return listing page for feedback
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $data = $this->feedbackRepository->index();

        return view('feedback.index')
            ->with([
                'data' => $data
            ]);
    }

    /**
     * Return form page to add new feedback
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('feedback.create');
    }

    /**
     * Validate the form data,
     * Store the form submitted data for new feedback,
     * & Redirect to feedback listing page
     *
     * @param StoreFeedbackRequest $request
     * @return RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(StoreFeedbackRequest $request)
    {
        $data = $request->only('category', 'title', 'description');
        $data['user_id'] = $request->user()->id;

        $this->feedbackRepository->create($data);

        return redirect()
            ->route('feedback.index')
            ->with([
                'success' => 'Feedback created successfully'
            ]);
    }

    /**
     *
     *
     * @param SubmitVoteFeedbackRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function vote(SubmitVoteFeedbackRequest $request): RedirectResponse
    {
        $data = $request->only('feedback_id', 'type');
        $data['user_id'] = $request->user()->id;

        $this->feedbackRepository->vote($data);

        return redirect()
            ->back()
            ->with([
                'success' => 'Vote successfully submitted'
            ]);
    }
}
