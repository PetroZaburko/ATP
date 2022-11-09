<?php

namespace App\Mail;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserSalaryToUserEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;

    /**
     * Create a new message instance.
     *
     * @param  User  $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.user_salary')
            ->subject('Info about your salary')
            ->with(
                [
                    'salary' => $this->user->salary,
                    'month' => Carbon::now()->addMonth()->getTranslatedMonthName('Do MMMM'),
                ]
            );
    }
}
