<?php

namespace App\Logger;

use Monolog\LogRecord;
use Monolog\Processor\ProcessorInterface;
use Symfony\Component\HttpFoundation\Exception\SessionNotFoundException;
use Symfony\Component\HttpFoundation\RequestStack;

class SessionRequestProcessor implements ProcessorInterface
{
    public function __construct(
        private RequestStack $requestStack
    ) {
    }

    // method is called for each log record; optimize it to not hurt performance
    public function __invoke(LogRecord $record): LogRecord
    {
        try {
            $session = $this->requestStack->getSession();
        } catch (SessionNotFoundException $e) {
            return $record;
        }
        if (!$session->isStarted()) {
            return $record;
        }

        $sessionId = substr($session->getId(), 0, 8) ?: '????????';

        $record->extra['token'] = $sessionId . '-' . substr(uniqid('', true), -8);

        return $record;
    }
}
