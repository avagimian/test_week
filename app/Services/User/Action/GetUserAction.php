<?php

namespace App\Services\User\Action;

use App\Repositories\Read\User\UserReadRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

class GetUserAction
{
    public function __construct(
        protected UserReadRepositoryInterface $userReadRepository
    ) {
    }

    public function run(): Collection
    {
        return $this->userReadRepository->index();
    }
}
