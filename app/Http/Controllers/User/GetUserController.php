<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\User\GetUserRequest;
use App\Http\Resources\User\UserResource;
use App\Services\User\Action\GetUserAction;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class GetUserController
{
    public function __invoke(
        GetUserRequest $request,
        GetUserAction $getUserAction
    ): AnonymousResourceCollection {
        $users = $getUserAction->run();

        return UserResource::collection($users);
    }
}
