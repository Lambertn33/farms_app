<?php

namespace App\Jobs;

use App\Services\MessagesServices;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UserCreated implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(private $user, private $defaultPassword)
    {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $message = 'Dear ' . $this->user['names'] . ' you have been added to the system as a ' . $this->user['role'] . ' with a default password ' . $this->defaultPassword . ' please login and change your default password';
        (new MessagesServices)->sendMessage($this->user['phone_no'], $message);
    }
}
