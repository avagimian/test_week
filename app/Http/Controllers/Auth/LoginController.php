<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\Auth\Login\LoginResource;
use App\Services\Auth\Login\Action\LoginAction;
use App\Services\Auth\Login\Dto\LoginUserDto;
use Illuminate\Auth\Access\AuthorizationException;
use Spatie\DataTransferObject\Exceptions\UnknownProperties;

class LoginController extends Controller
{
    /**
     * @throws UnknownProperties
     * @throws AuthorizationException
     */
    public function __invoke(
        LoginRequest $request,
        LoginAction $loginAction
    ): LoginResource {
        $dto = LoginUserDto::fromRequest($request);

        $result = $loginAction->run($dto);

        return new LoginResource($result);
    }
}
