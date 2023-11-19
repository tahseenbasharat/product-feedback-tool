<?php

namespace App\Repositories;

use App\Interfaces\Repositories\UserRepositoryInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class UserRepository implements UserRepositoryInterface
{
    protected Builder $userModel;

    /**
     * Injecting Builder instance
     */
    public function __construct()
    {
        $this->userModel = User::query();
    }

    /**
     * Delete user record from database
     *
     * @param Model $model
     * @return bool
     */
    public function destroy(Model $model): bool
    {
        return $model->delete() ?: FALSE;
    }

    /**
     * return paginated <User> results
     *
     * @return LengthAwarePaginator
     */
    public function paginatedList(): LengthAwarePaginator
    {
        return $this->userModel
            ->select('*')
            ->orderBy('name', 'desc')
            ->paginate();
    }
}
