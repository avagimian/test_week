<?php

namespace App\Console\Commands;

use App\Repositories\Read\User\UserReadRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CleanupRecordsCommand extends Command
{
    protected $signature = 'cleanup-records:run';
    protected $description = 'Cleanup records';

    public function handle(
        UserReadRepositoryInterface $userReadRepository
    ): void {
        $start = Carbon::now();
        $this->info("Cleanup started at: " . $start);

        $weekAgo = Carbon::now()->subWeek();
        $count = $userReadRepository->getCleanUpRecordsCount($weekAgo);

        $end = Carbon::now();
        $this->info("Count: " . $count);
        $this->info("Cleanup completed at: " . $end);
    }
}
