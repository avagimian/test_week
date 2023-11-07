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

    public function getCleanUpRecordsCount(string $weekAgo): int
    {
        return $this->query()
            ->where('created_at', '<', $weekAgo)
            ->whereNotExists(function ($query) {
                $query->from('user_teams')
                    ->whereRaw('users.id = user_teams.user_id');
            })->count();
    }
}
