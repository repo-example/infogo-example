<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class RedisMessageService implements MessageServiceInterface
{
    public function push($message)
    {
        // do something
        Log::debug('push: ' . var_export($message, 1));
    }
}
