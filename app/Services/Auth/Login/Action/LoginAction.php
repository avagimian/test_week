<?php

namespace App\Services\Auth\Login\Action;

use App\Exceptions\CheckPasswordException;
use App\Repositories\Read\User\UserReadRepositoryInterface;
use App\Services\Auth\Login\Dto\LoginUserDto;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Http;
use Laravel\Passport\Client;

class LoginAction
{
    public function __construct(
        protected UserReadRepositoryInterface $userReadRepository
    ) {
    }

    /**
     * @throws AuthorizationException
     * @throws \Exception
     */
    public function run(LoginUserDto $dto): object
    {
        $user = $this->userReadRepository->getByEmail($dto->email);

        $check = password_verify($dto->password, $user->password);

        if (!$check) {
            throw new CheckPasswordException();
        }

        $oClientId = config('passport.passport_grant_client.id');
        $oClient = Client::query()->where('id', $oClientId)->first();

        $response = Http::asForm()->post(env('APP_URL') . '/oauth/token', [
            'grant_type' => 'password',
            'client_id' => $oClient->id,
            'client_secret' => $oClient->secret,
            'username' => $dto->email,
            'password' => $dto->password,
            'scope' => '*',
        ]);

        $data = json_decode($response->getBody()->getContents());
        $data->user = $user;

        return $data;
    }
}
