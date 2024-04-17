<?php

namespace App\Console\Commands;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class BlockInactiveUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'block:inactive-users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Blocks users who have not logged in for a specified period.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $inactiveUsers = User::where('last_login_at', '<=', Carbon::now()->subDays(3))->get();

        foreach ($inactiveUsers as $user) {
            $user->is_blocked = true;
            $user->save();
        }

        $this->info('Inactive users have been blocked successfully.');
    }
}
