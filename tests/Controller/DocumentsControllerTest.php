<?php

namespace App\Test\Controller;

use App\Entity\Documents;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DocumentsControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $repository;
    private string $path = '/documents/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->repository = $this->manager->getRepository(Documents::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Document index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'document[tokenId]' => 'Testing',
            'document[type]' => 'Testing',
            'document[createAt]' => 'Testing',
            'document[file]' => 'Testing',
            'document[isValid]' => 'Testing',
            'document[description]' => 'Testing',
            'document[myme]' => 'Testing',
            'document[originalname]' => 'Testing',
            'document[size]' => 'Testing',
        ]);

        self::assertResponseRedirects('/sweet/food/');

        self::assertSame(1, $this->getRepository()->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Documents();
        $fixture->setTokenId('My Title');
        $fixture->setType('My Title');
        $fixture->setCreateAt('My Title');
        $fixture->setFile('My Title');
        $fixture->setIsValid('My Title');
        $fixture->setDescription('My Title');
        $fixture->setMyme('My Title');
        $fixture->setOriginalname('My Title');
        $fixture->setSize('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Document');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Documents();
        $fixture->setTokenId('Value');
        $fixture->setType('Value');
        $fixture->setCreateAt('Value');
        $fixture->setFile('Value');
        $fixture->setIsValid('Value');
        $fixture->setDescription('Value');
        $fixture->setMyme('Value');
        $fixture->setOriginalname('Value');
        $fixture->setSize('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'document[tokenId]' => 'Something New',
            'document[type]' => 'Something New',
            'document[createAt]' => 'Something New',
            'document[file]' => 'Something New',
            'document[isValid]' => 'Something New',
            'document[description]' => 'Something New',
            'document[myme]' => 'Something New',
            'document[originalname]' => 'Something New',
            'document[size]' => 'Something New',
        ]);

        self::assertResponseRedirects('/documents/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getTokenId());
        self::assertSame('Something New', $fixture[0]->getType());
        self::assertSame('Something New', $fixture[0]->getCreateAt());
        self::assertSame('Something New', $fixture[0]->getFile());
        self::assertSame('Something New', $fixture[0]->getIsValid());
        self::assertSame('Something New', $fixture[0]->getDescription());
        self::assertSame('Something New', $fixture[0]->getMyme());
        self::assertSame('Something New', $fixture[0]->getOriginalname());
        self::assertSame('Something New', $fixture[0]->getSize());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new Documents();
        $fixture->setTokenId('Value');
        $fixture->setType('Value');
        $fixture->setCreateAt('Value');
        $fixture->setFile('Value');
        $fixture->setIsValid('Value');
        $fixture->setDescription('Value');
        $fixture->setMyme('Value');
        $fixture->setOriginalname('Value');
        $fixture->setSize('Value');

        $this->manager->remove($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/documents/');
        self::assertSame(0, $this->repository->count([]));
    }
}
