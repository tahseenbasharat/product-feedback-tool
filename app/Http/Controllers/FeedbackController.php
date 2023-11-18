<?php

namespace App\Http\Controllers;

use App\Enums\FeedbackCategoryEnum;
use App\Interfaces\FeedbackRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('feedback.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'category' => ['required', Rule::enum(FeedbackCategoryEnum::class)],
            'title' => 'required',
            'description' => 'required',
        ]);

        $data = $request->only('category', 'title', 'description');
        $data['user_id'] = $request->user()->id;

        $this->feedbackRepository->create($data);

        return redirect()
            ->route('authenticated.feedback.index')
            ->with([
                'success' => 'Feedback created successfully'
            ]);
    }
}
