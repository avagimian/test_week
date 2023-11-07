<?php

namespace App\Events;

use App\Models\User;
use App\Services\User\Dto\UserDto;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UpdateUserEvent
{
    use Dispatchable, SerializesModels;

    public function __construct(
        public UserDto $dto,
        public User $user
    ) {
    }
}

