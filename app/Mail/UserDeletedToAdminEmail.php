<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserDeletedToAdminEmail extends Mailable
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
        return $this->view('mails.user_deleted_to_admin')
            ->subject('User deleted from '.env('APP_NAME'))
            ->with(
                [
                    'user' => $this->user,
                    'buses' => $this->user->buses->implode('number', ', '),
                ]
            );
    }
}
