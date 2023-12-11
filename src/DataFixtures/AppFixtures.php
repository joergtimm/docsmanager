<?php

namespace App\DataFixtures;

use App\Entity\Actor;
use App\Factory\ActorFactory;
use App\Factory\ProductionFactory;
use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        UserFactory::createOne();
        ActorFactory::createMany(5, ['name' => 'Jörg']);
        ProductionFactory::createMany(50);

        $manager->flush();
    }
}
