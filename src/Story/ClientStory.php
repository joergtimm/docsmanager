<?php

namespace App\Story;

use App\Factory\ClientFactory;
use Zenstruck\Foundry\Story;

final class ClientStory extends Story
{
    public function build(): void
    {
        //  build your story here (https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#stories)
        ClientFactory::createMany(22);
    }
}
