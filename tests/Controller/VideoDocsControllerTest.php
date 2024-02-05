<?php

namespace App\Test\Controller;

use App\Entity\VideoDocs;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class VideoDocsControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $repository;
    private string $path = '/video/docs/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->repository = $this->manager->getRepository(VideoDocs::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('VideoDoc index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'video_doc[createAt]' => 'Testing',
            'video_doc[video]' => 'Testing',
            'video_doc[document]' => 'Testing',
        ]);

        self::assertResponseRedirects('/sweet/food/');

        self::assertSame(1, $this->getRepository()->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new VideoDocs();
        $fixture->setCreateAt('My Title');
        $fixture->setVideo('My Title');
        $fixture->setDocument('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('VideoDoc');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new VideoDocs();
        $fixture->setCreateAt('Value');
        $fixture->setVideo('Value');
        $fixture->setDocument('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'video_doc[createAt]' => 'Something New',
            'video_doc[video]' => 'Something New',
            'video_doc[document]' => 'Something New',
        ]);

        self::assertResponseRedirects('/video/docs/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getCreateAt());
        self::assertSame('Something New', $fixture[0]->getVideo());
        self::assertSame('Something New', $fixture[0]->getDocument());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new VideoDocs();
        $fixture->setCreateAt('Value');
        $fixture->setVideo('Value');
        $fixture->setDocument('Value');

        $this->manager->remove($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/video/docs/');
        self::assertSame(0, $this->repository->count([]));
    }
}
