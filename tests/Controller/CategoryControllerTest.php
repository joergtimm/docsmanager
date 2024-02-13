<?php

namespace App\Test\Controller;

use App\Entity\Category;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CategoryControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $repository;
    private string $path = '/category/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->repository = $this->manager->getRepository(Category::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Category index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'category[title]' => 'Testing',
            'category[description]' => 'Testing',
            'category[slug]' => 'Testing',
            'category[lft]' => 'Testing',
            'category[rgt]' => 'Testing',
            'category[root]' => 'Testing',
            'category[level]' => 'Testing',
            'category[created]' => 'Testing',
            'category[updated]' => 'Testing',
            'category[createdBy]' => 'Testing',
            'category[updatedBy]' => 'Testing',
            'category[parent]' => 'Testing',
        ]);

        self::assertResponseRedirects('/sweet/food/');

        self::assertSame(1, $this->getRepository()->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Category();
        $fixture->setTitle('My Title');
        $fixture->setDescription('My Title');
        $fixture->setSlug('My Title');
        $fixture->setLft('My Title');
        $fixture->setRgt('My Title');
        $fixture->setRoot('My Title');
        $fixture->setLevel('My Title');
        $fixture->setCreated('My Title');
        $fixture->setUpdated('My Title');
        $fixture->setCreatedBy('My Title');
        $fixture->setUpdatedBy('My Title');
        $fixture->setParent('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Category');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Category();
        $fixture->setTitle('Value');
        $fixture->setDescription('Value');
        $fixture->setSlug('Value');
        $fixture->setLft('Value');
        $fixture->setRgt('Value');
        $fixture->setRoot('Value');
        $fixture->setLevel('Value');
        $fixture->setCreated('Value');
        $fixture->setUpdated('Value');
        $fixture->setCreatedBy('Value');
        $fixture->setUpdatedBy('Value');
        $fixture->setParent('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'category[title]' => 'Something New',
            'category[description]' => 'Something New',
            'category[slug]' => 'Something New',
            'category[lft]' => 'Something New',
            'category[rgt]' => 'Something New',
            'category[root]' => 'Something New',
            'category[level]' => 'Something New',
            'category[created]' => 'Something New',
            'category[updated]' => 'Something New',
            'category[createdBy]' => 'Something New',
            'category[updatedBy]' => 'Something New',
            'category[parent]' => 'Something New',
        ]);

        self::assertResponseRedirects('/category/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getTitle());
        self::assertSame('Something New', $fixture[0]->getDescription());
        self::assertSame('Something New', $fixture[0]->getSlug());
        self::assertSame('Something New', $fixture[0]->getLft());
        self::assertSame('Something New', $fixture[0]->getRgt());
        self::assertSame('Something New', $fixture[0]->getRoot());
        self::assertSame('Something New', $fixture[0]->getLevel());
        self::assertSame('Something New', $fixture[0]->getCreated());
        self::assertSame('Something New', $fixture[0]->getUpdated());
        self::assertSame('Something New', $fixture[0]->getCreatedBy());
        self::assertSame('Something New', $fixture[0]->getUpdatedBy());
        self::assertSame('Something New', $fixture[0]->getParent());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new Category();
        $fixture->setTitle('Value');
        $fixture->setDescription('Value');
        $fixture->setSlug('Value');
        $fixture->setLft('Value');
        $fixture->setRgt('Value');
        $fixture->setRoot('Value');
        $fixture->setLevel('Value');
        $fixture->setCreated('Value');
        $fixture->setUpdated('Value');
        $fixture->setCreatedBy('Value');
        $fixture->setUpdatedBy('Value');
        $fixture->setParent('Value');

        $this->manager->remove($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/category/');
        self::assertSame(0, $this->repository->count([]));
    }
}
