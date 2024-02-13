<?php

namespace App\EventSubscriber;

use App\Entity\User;
use JetBrains\PhpStorm\ArrayShape;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class SetIsMeOnCurrentUserSubscriber implements EventSubscriberInterface
{
    public function __construct(private readonly Security $security)
    {
    }

    public function onRequestEvent(RequestEvent $event): void
    {
        if ($event->isMainRequest()) {
            /** @var User|null $user */
            $user = $this->security->getUser();
            if (!$user) {
                return;
            }

            $user->setIsMe(true);
        }
    }

    #[ArrayShape([RequestEvent::class => 'string'])]
    public static function getSubscribedEvents(): array
    {
        return [
               RequestEvent::class => 'onRequestEvent',
           ];
    }
}
