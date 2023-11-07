<?php

namespace App\Listeners;

use App\Events\UpdateUserEvent;
use App\Repositories\Write\User\UserWriteRepositoryInterface;

class UpdateUserListener
{
    public function __construct(
        protected UserWriteRepositoryInterface $userWriteRepository
    ) {
    }

    public function handle(UpdateUserEvent $event): void
    {
        $user = $event->user->updateUser($event->dto, $event->user);
        $this->userWriteRepository->save($user);
    }
}
