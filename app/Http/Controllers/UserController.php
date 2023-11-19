<?php

namespace App\Http\Controllers;

use App\Interfaces\Repositories\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class UserController extends Controller
{
    private UserRepositoryInterface $feedbackRepository;

    /**
     * Injecting FeedbackRepositoryInterface
     *
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Delete user record from database
     *
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(User $user): RedirectResponse
    {
        $deleted = $this->userRepository->destroy($user);

        $r = match ($deleted) {
            TRUE => [
                'alertType' => 'alert-success',
                'message' => 'User record deleted successfully',
            ],
            FALSE => [
                'alertType' => 'alert-danger',
                'message' => 'Something went wrong deleting the user'
            ]
        };

        Session::flash($r['alertType'], $r['message']);

        return redirect()
            ->back();
    }

    /**
     * Return listing page for users
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(): View
    {
        $data = $this->userRepository->paginatedList();

        return view('user.index')
            ->with([
                'data' => $data,
            ]);
    }
}
