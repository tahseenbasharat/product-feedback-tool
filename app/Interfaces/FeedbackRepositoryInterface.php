<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface FeedbackRepositoryInterface
{
    public function index(): LengthAwarePaginator;
    public function create(array $data): Model;
}
