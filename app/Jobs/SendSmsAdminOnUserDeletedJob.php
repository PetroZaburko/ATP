<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Psr\Http\Client\ClientExceptionInterface;
use Vonage\Client;
use Vonage\Client\Credentials\Basic;

class SendSmsAdminOnUserDeletedJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    protected $smsFrom;
    protected $smsTo;

    /**
     * Create a new job instance.
     *
     * @param  User  $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
        $this->smsFrom = env('APP_NAME');
        $this->smsTo = config('atp.admin_phone');
    }

    /**
     * Execute the job.
     *
     * @return void
     * @throws ClientExceptionInterface
     */
    public function handle()
    {
        try {
            $basic = new Basic(getenv("SMS_NEXMO_KEY"), getenv("SMS_NEXMO_SECRET"));
            $client = new Client($basic);

            $buses = $this->user->buses->implode('number', ', ');
            $message = "Водій {$this->user->full_name} сьогодні вийшов не пенсію, автобуси, з номерними знаками {$buses} залишилися без водія";

            $sms = $client->sms()->send(
                [
                    'to' => $this->smsTo,
                    'from' => $this->smsFrom,
                    'text' => $message
                ]
            );
        } catch (Client\Exception\Exception $e) {
            log("Error: ".$e->getMessage());
        }
    }
}
