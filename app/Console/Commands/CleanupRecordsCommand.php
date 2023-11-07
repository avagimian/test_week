<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CleanupRecordsCommand extends Command
{
    protected $signature = 'cleanup-records:run';
    protected $description = 'Cleanup records';

    public function __construct()
    {
        parent::__construct();

//        event(new ModelCreatedOrUpdated($model, auth()->user()));
    }

    public function handle(): void
    {

        event(new UserCreating($user));

        $start = Carbon::now();
        $this->info("Cleanup started at: " . $start);

        $weekAgo = Carbon::now()->subWeek();
        $count = DB::table('users')
            ->where('created_at', '<', $weekAgo)
            ->whereNotExists(function ($query) {
                $query->from('user_teams')
                    ->whereRaw('users.id = user_teams.user_id');
            })->count();

        $end = Carbon::now();
        $this->info("Count: " . $count);
        $this->info("Cleanup completed at: " . $end);
    }
}
