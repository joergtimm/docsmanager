<?php

namespace App\MessageHandler;

use App\Message\SendPushState;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final class SendPushStateHandler
{
    public function __invoke(SendPushState $message)
    {
        // do something with your message
    }
}
