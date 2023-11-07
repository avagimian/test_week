<?php

namespace App\Services\User\Action;

use App\Events\CreateUserEvent;
use App\Events\UpdateUserEvent;
use App\Repositories\Read\User\UserReadRepositoryInterface;
use App\Services\User\Dto\UserDto;

class UserAction
{
    public function __construct(
        protected UserReadRepositoryInterface $userReadRepository
    ) {
    }

    public function run(UserDto $dto): void
    {
        $user = $this->userReadRepository->getByEmail($dto->email);

        if (is_null($user)) {
            CreateUserEvent::dispatch($dto);
        } else {
            UpdateUserEvent::dispatch($dto, $user);
        }
    }
}
