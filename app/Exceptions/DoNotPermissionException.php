<?php

namespace App\Exceptions;

class DoNotPermissionException extends BusinessLogicException
{
    public function getStatus(): int
    {
        return BusinessLogicException::PERMISSION_DENIED;
    }

    public function getStatusMessage(): string
    {
        return 'Permission denied';
    }
}
