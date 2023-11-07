<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserRequest;
use App\Services\User\Action\UserAction;
use App\Services\User\Dto\UserDto;
use Illuminate\Http\JsonResponse;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class UserController extends Controller
{
    /**
     * @throws UnknownProperties
     */
    public function __invoke(
        UserRequest $request,
        UserAction $userAction
    ): JsonResponse {
        $dto = UserDto::fromRequest($request);

        $userAction->run($dto);

        return $this->response();
    }
}
