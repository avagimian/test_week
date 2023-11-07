<?php

namespace App\Listeners;

use App\Events\CreateUserEvent;
use App\Models\User;
use App\Repositories\Write\User\UserWriteRepositoryInterface;

class CreateUserListener
{
    public function __construct(
        protected UserWriteRepositoryInterface $userWriteRepository
    ) {
    }

    public function handle(CreateUserEvent $event): void
    {
        $user = User::staticCreate($event->dto);
        $this->userWriteRepository->save($user);
    }
}
