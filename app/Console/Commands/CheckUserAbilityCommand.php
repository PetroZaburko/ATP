<?php

namespace App\Console\Commands;

use App\Jobs\SendEmailAdminOnUserDeletedJob;
use App\Jobs\SendSmsAdminOnUserDeletedJob;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;

class CheckUserAbilityCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:user-ability';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check all users age ability';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        User::chunk(
            1000,
            function (Collection $group) {
                $group->each(
                    function (User $user) {
                        if (!$user->checkAgeAbility()) {
                            $user->delete();
                            SendSmsAdminOnUserDeletedJob::dispatch($user)->delay(Carbon::now()->addMinutes(5));
                            SendEmailAdminOnUserDeletedJob::dispatch($user)->delay(Carbon::now()->addMinutes(15));
                        }
                    }
                );
            }
        );
    }
}
