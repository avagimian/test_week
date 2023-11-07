<?php

namespace App\Repositories\Read\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

interface UserReadRepositoryInterface
{
    public function index(): Collection;

    public function getByEmail(string $email): ?User;

    public function getCleanUpRecordsCount(string $weekAgo): int;
}
