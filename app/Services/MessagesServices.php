<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class MessagesServices
{

    public function sendMessage($telephone, $message)
    {
        return Http::withHeaders([
            'Authorization' => 'Bearer ' . env("SMS_TOKEN") . '',
        ])->acceptJson()
            ->post('' . env("SMS_URL") . '', [
                'sender' => 'Lambertn33',
                'to' => '+' . $telephone,
                'text' => $message
            ]);
    }
}
