<?php

namespace App\DataFixtures;

use App\Entity\Actor;
use App\Factory\ActorFactory;
use App\Factory\ContractBlocksFactory;
use App\Factory\MandnatFactory;
use App\Factory\ProductionFactory;
use App\Factory\UserFactory;
use App\Factory\VideoActorsFactory;
use App\Factory\VideoFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        UserFactory::createOne(['email' => 'timm.jrg@gmail.com',
            'password' => '+SuperPassword123',
            'roles' => ["ROLE_ADMIN", "ROLE_SUPER_ADMIN"]]);
        UserFactory::createMany(15);
        ActorFactory::createMany(50);
        ProductionFactory::createMany(50);
        MandnatFactory::createMany(50);
        VideoFactory::createMany(100, function () {
            return [
                'videoActors' => VideoActorsFactory::new(function () {
                    return [
                        'actor' => ActorFactory::random(),
                    ];
                })->many(2, 4),
            ];
        });
        ContractBlocksFactory::createMany(20);

        $manager->flush();
    }
}
