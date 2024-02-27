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
    public function __construct(private DocumentManager $documentManager)
    {
    }

    /**
     * @throws FilesystemException
     */
    public function load(ObjectManager $manager): void
    {
        UserFactory::createOne(['email' => 'admin@example.com',
            'password' => '+SuperPassword123',
            'roles' => ["ROLE_ADMIN", "ROLE_SUPER_ADMIN"]]);
        UserFactory::createMany(15);
        $clients = ClientFactory::createMany(50);
        $actors = ActorFactory::createMany(50, function () use ($clients) {
            return [
                'actorClients' => ActorClientFactory::new(function () use ($clients) {
                    return [
                        'client' => $clients[array_rand($clients)],
                    ];
                })->many(1, 5),
            ];
        });
        ProductionFactory::createMany(50);
        MandnatFactory::createMany(50);
        VideoFactory::createMany(100, function () use ($clients) {
            return [
                'owner' => $clients[array_rand($clients)],
                'videoActors' => VideoActorsFactory::new(function () {
                    return [
                        'actor' => ActorFactory::random(),
                    ];
                })->many(2, 4),
            ];
        });
        ContractBlocksFactory::createMany(20);

        foreach ($actors as $actor) {
            $files = ['fm1.jpg',
                'fm2.jpg',
                'fm3.jpg',
                'fm4.jpg',
                'fm5.jpg',
                'fm6.jpg',
                'fm7.jpg',
                'fm8.jpg',
                'fm9.jpg',
                'fm10.jpg',
                'fm11.jpg',
                'fm12.jpg'];

            $rand_keys = array_rand($files, 11);
            $imgName = __DIR__ . "/../../assets/img/" . $files[$rand_keys[1]];
            $profile = new UploadedFile(
                $imgName,
                $imgName,
                null,
                null,
                false,
            );
            $actor->setImageFile($profile);
        }

        $manager->flush();

        $this->documentManager->purgeFixturesVodeoActorDocs();
        $this->documentManager->copyVideoActorDocsFixtures();
    }
}
