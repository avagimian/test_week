<?php

namespace App\Events;

use App\Services\User\Dto\UserDto;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CreateUserEvent
{
    use Dispatchable, SerializesModels;

    public function __construct(
        public UserDto $dto
    ) {
    }
}
