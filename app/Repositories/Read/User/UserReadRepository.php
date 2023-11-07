<?php

namespace App\Repositories\Read\User;

use App\Models\User;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class UserReadRepository implements UserReadRepositoryInterface
{
    private function query(): Builder
    {
        return User::query();
    }

    public function index(): Collection
    {
        return $this->query()->get();
    }

    public function getByEmail(string $email): ?User
    {
        return $this->query()->where('email', $email)->first();
    }
}
