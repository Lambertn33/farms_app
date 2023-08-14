<?php

namespace App\Jobs;

use App\Models\Farm;
use App\Services\MessagesServices;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class FarmApprovedOrRejected implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(private $farm, private $status, private $user)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $status = $this->status === Farm::REJECTED ? 'rejected' : 'approved';
        $message = 'Dear ' . $this->user->names . ' your farm registration request with farm number ' . $this->farm->farm_number . ' with the name of '.$this->farm->name. 'has been' . $status . ' ..';
        (new MessagesServices)->sendMessage($this->user->phone_no, $message);
    }
}
