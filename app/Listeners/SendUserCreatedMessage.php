<?php

namespace App\Listeners;

use App\Events\UserCreated;
use App\Services\MessageServiceInterface;

class SendUserCreatedMessage
{
    private $messageService;

    public function __construct(MessageServiceInterface $messageService)
    {
        $this->messageService = $messageService;
    }

    /**
     * Handle the event.
     *
     * @param  UserCreated  $event
     * @return void
     */
    public function handle(UserCreated $event)
    {
        $user = $event->user;

        $message = [
            'user' => $user->toArray(),
            'xyz' => '11'
        ];

        $this->messageService->push($message);
    }
}
