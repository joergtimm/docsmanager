<?php

namespace App\Test\Controller;

use App\Entity\Participant;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ParticipantControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $repository;
    private string $path = '/participant/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->repository = $this->manager->getRepository(Participant::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Participant index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'participant[name]' => 'Testing',
            'participant[firstName]' => 'Testing',
            'participant[bornAt]' => 'Testing',
            'participant[birthName]' => 'Testing',
            'participant[idType]' => 'Testing',
            'participant[idNumber]' => 'Testing',
            'participant[createAt]' => 'Testing',
            'participant[updateAt]' => 'Testing',
            'participant[video]' => 'Testing',
        ]);

        self::assertResponseRedirects('/sweet/food/');

        self::assertSame(1, $this->getRepository()->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Participant();
        $fixture->setName('My Title');
        $fixture->setFirstName('My Title');
        $fixture->setBornAt('My Title');
        $fixture->setBirthName('My Title');
        $fixture->setIdType('My Title');
        $fixture->setIdNumber('My Title');
        $fixture->setCreateAt('My Title');
        $fixture->setUpdateAt('My Title');
        $fixture->setVideo('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Participant');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Participant();
        $fixture->setName('Value');
        $fixture->setFirstName('Value');
        $fixture->setBornAt('Value');
        $fixture->setBirthName('Value');
        $fixture->setIdType('Value');
        $fixture->setIdNumber('Value');
        $fixture->setCreateAt('Value');
        $fixture->setUpdateAt('Value');
        $fixture->setVideo('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'participant[name]' => 'Something New',
            'participant[firstName]' => 'Something New',
            'participant[bornAt]' => 'Something New',
            'participant[birthName]' => 'Something New',
            'participant[idType]' => 'Something New',
            'participant[idNumber]' => 'Something New',
            'participant[createAt]' => 'Something New',
            'participant[updateAt]' => 'Something New',
            'participant[video]' => 'Something New',
        ]);

        self::assertResponseRedirects('/participant/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getName());
        self::assertSame('Something New', $fixture[0]->getFirstName());
        self::assertSame('Something New', $fixture[0]->getBornAt());
        self::assertSame('Something New', $fixture[0]->getBirthName());
        self::assertSame('Something New', $fixture[0]->getIdType());
        self::assertSame('Something New', $fixture[0]->getIdNumber());
        self::assertSame('Something New', $fixture[0]->getCreateAt());
        self::assertSame('Something New', $fixture[0]->getUpdateAt());
        self::assertSame('Something New', $fixture[0]->getVideo());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new Participant();
        $fixture->setName('Value');
        $fixture->setFirstName('Value');
        $fixture->setBornAt('Value');
        $fixture->setBirthName('Value');
        $fixture->setIdType('Value');
        $fixture->setIdNumber('Value');
        $fixture->setCreateAt('Value');
        $fixture->setUpdateAt('Value');
        $fixture->setVideo('Value');

        $this->manager->remove($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/participant/');
        self::assertSame(0, $this->repository->count([]));
    }
}
