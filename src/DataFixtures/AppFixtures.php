<?php

namespace App\DataFixtures;

use App\Entity\Actor;
use App\Entity\Client;
use App\Factory\ActorClientFactory;
use App\Factory\ActorFactory;
use App\Factory\ClientFactory;
use App\Factory\ContractBlocksFactory;
use App\Factory\MandnatFactory;
use App\Factory\ParticipantFactory;
use App\Factory\ProductionFactory;
use App\Factory\UserFactory;
use App\Factory\VideoActorsFactory;
use App\Factory\VideoFactory;
use App\Service\DocumentManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use League\Flysystem\FilesystemException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        UserFactory::createOne(['email' => 'jt@ipps.de',
            'password' => 'rZlPUffq92QJ',
            'roles' => ["ROLE_ADMIN", "ROLE_SUPER_ADMIN"]]);
        UserFactory::createOne(['email' => 'rs@ipps.de',
            'password' => 'zme4M4S2Wuu2',
            'roles' => ["ROLE_ADMIN", "ROLE_SUPER_ADMIN"]]);
        ClientFactory::createOne([
            'name' => ' Frank Plate',
            'company' => 'GB-Media',
            'country' => 'de-DE',
            'locality' => 'Bremen',
            'region' => 'Bremen',
            'postalCode' => '28145',
            'streetAddress' => 'Alte Dorfstraße 21',
            'email' => 'info@german-gabgbang.com',
            'telephone' => '+49 1577 3886650'
            ]);

        $manager->flush();
    }
}
