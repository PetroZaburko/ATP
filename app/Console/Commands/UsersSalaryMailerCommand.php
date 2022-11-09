<?php

namespace App\Console\Commands;

use App\Jobs\SendEmailUserAboutSalaryJob;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;

class UsersSalaryMailerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:users-salary';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email to all users with salary info';

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
                        SendEmailUserAboutSalaryJob::dispatch($user);
                    }
                );
            }
        );
    }
}
