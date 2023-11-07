<?php

namespace App\Services\User\Dto;

use App\Http\Requests\User\UserRequest;
use Spatie\DataTransferObject\DataTransferObject;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class UserDto extends DataTransferObject
{
    public string $name;
    public string $email;
    public string $password;

    /**
     * @throws UnknownProperties
     */
    public static function fromRequest(UserRequest $request): UserDto
    {
        return new self(
            name: $request->getName(),
            email: $request->getEmail(),
            password: $request->getPassword(),
        );
    }
}
