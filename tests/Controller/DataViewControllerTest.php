<?php

namespace App\Test\Controller;

use App\Entity\DataView;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DataViewControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $repository;
    private string $path = '/data/view/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->repository = $this->manager->getRepository(DataView::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('DataView index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'data_view[type]' => 'Testing',
            'data_view[title]' => 'Testing',
            'data_view[gridlist]' => 'Testing',
            'data_view[searchProbs]' => 'Testing',
            'data_view[createAt]' => 'Testing',
            'data_view[updateAt]' => 'Testing',
            'data_view[user]' => 'Testing',
        ]);

        self::assertResponseRedirects('/sweet/food/');

        self::assertSame(1, $this->getRepository()->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new DataView();
        $fixture->setType('My Title');
        $fixture->setTitle('My Title');
        $fixture->setGridlist('My Title');
        $fixture->setSearchProbs('My Title');
        $fixture->setCreateAt('My Title');
        $fixture->setUpdateAt('My Title');
        $fixture->setUser('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('DataView');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new DataView();
        $fixture->setType('Value');
        $fixture->setTitle('Value');
        $fixture->setGridlist('Value');
        $fixture->setSearchProbs('Value');
        $fixture->setCreateAt('Value');
        $fixture->setUpdateAt('Value');
        $fixture->setUser('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'data_view[type]' => 'Something New',
            'data_view[title]' => 'Something New',
            'data_view[gridlist]' => 'Something New',
            'data_view[searchProbs]' => 'Something New',
            'data_view[createAt]' => 'Something New',
            'data_view[updateAt]' => 'Something New',
            'data_view[user]' => 'Something New',
        ]);

        self::assertResponseRedirects('/data/view/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getType());
        self::assertSame('Something New', $fixture[0]->getTitle());
        self::assertSame('Something New', $fixture[0]->getGridlist());
        self::assertSame('Something New', $fixture[0]->getSearchProbs());
        self::assertSame('Something New', $fixture[0]->getCreateAt());
        self::assertSame('Something New', $fixture[0]->getUpdateAt());
        self::assertSame('Something New', $fixture[0]->getUser());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new DataView();
        $fixture->setType('Value');
        $fixture->setTitle('Value');
        $fixture->setGridlist('Value');
        $fixture->setSearchProbs('Value');
        $fixture->setCreateAt('Value');
        $fixture->setUpdateAt('Value');
        $fixture->setUser('Value');

        $this->manager->remove($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/data/view/');
        self::assertSame(0, $this->repository->count([]));
    }
}
