<?php

namespace App\Interfaces\Repositories;

use App\Interfaces\Repositories\Base\DestroyInterface;
use App\Interfaces\Repositories\Base\PaginateInterface;

interface UserRepositoryInterface extends DestroyInterface, PaginateInterface
{
}
