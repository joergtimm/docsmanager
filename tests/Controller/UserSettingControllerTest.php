<?php

namespace App\Test\Controller;

use App\Entity\UserSetting;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserSettingControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private EntityManagerInterface $manager;
    private EntityRepository $repository;
    private string $path = '/user/setting/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->manager = static::getContainer()->get('doctrine')->getManager();
        $this->repository = $this->manager->getRepository(UserSetting::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }

        $this->manager->flush();
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('UserSetting index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'user_setting[isClientFilter]' => 'Testing',
            'user_setting[user]' => 'Testing',
            'user_setting[clientInUse]' => 'Testing',
        ]);

        self::assertResponseRedirects('/sweet/food/');

        self::assertSame(1, $this->getRepository()->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new UserSetting();
        $fixture->setIsClientFilter('My Title');
        $fixture->setUser('My Title');
        $fixture->setClientInUse('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('UserSetting');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new UserSetting();
        $fixture->setIsClientFilter('Value');
        $fixture->setUser('Value');
        $fixture->setClientInUse('Value');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'user_setting[isClientFilter]' => 'Something New',
            'user_setting[user]' => 'Something New',
            'user_setting[clientInUse]' => 'Something New',
        ]);

        self::assertResponseRedirects('/user/setting/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getIsClientFilter());
        self::assertSame('Something New', $fixture[0]->getUser());
        self::assertSame('Something New', $fixture[0]->getClientInUse());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new UserSetting();
        $fixture->setIsClientFilter('Value');
        $fixture->setUser('Value');
        $fixture->setClientInUse('Value');

        $this->manager->remove($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/user/setting/');
        self::assertSame(0, $this->repository->count([]));
    }
}
