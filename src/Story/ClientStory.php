<?php

namespace App\Story;

use App\Entity\Client;
use App\Entity\Video;
use App\Factory\ClientFactory;
use Doctrine\ORM\EntityManagerInterface;
use Zenstruck\Foundry\Story;

final class ClientStory extends Story
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }
    public function build(): void
    {
        //  build your story here (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#stories)
        ClientFactory::createMany(22);

            $this->entityManager->flush();
    }
}
