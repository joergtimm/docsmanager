<?php

namespace App\Service;

use App\Entity\Client;
use App\Entity\DataView;
use App\Entity\User;
use App\Repository\DataViewRepository;
use App\Repository\UserSettingRepository;
use Doctrine\ORM\EntityManagerInterface;

class DataViewManager
{
    public const VIDEO = 'video';
    public const CLIENT = 'client';
    public const USER = 'user';
    public const ACTOR = 'actor';

    public function __construct(private DataViewRepository $repository, private EntityManagerInterface $em)
    {
    }

    public function getDefaults(string $type): array
    {
        $defaults = [];
        switch ($type) {
            case self::VIDEO:
                $defaults = [
                    'title' => 'Videos',
                    'gridlist' => 'list',
                    'searchProbs' =>
                        ['title', 'createAt']
                ];
                break;
            case self::CLIENT:
                $defaults = [
                    'title' => 'Clients',
                    'gridlist' => 'list',
                    'searchProbs' =>
                        ['Name', 'company', 'country']
                ];
                break;
            case self::USER:
                $defaults = [
                    'title' => 'User',
                    'gridlist' => 'list',
                    'searchProbs' =>
                        ['username', 'email']
                ];
                break;
            case self::ACTOR:
                $defaults = [
                    'title' => 'Actor',
                    'gridlist' => 'list',
                    'searchProbs' =>
                        ['name']
                ];
                break;
        }
        return $defaults;
    }
    public function setDataView(User $user, ?string $type): DataView
    {
        $dataView = $this->repository->findOneBy(['user' => $user, 'type' => $type]);
        if (!$dataView) {
            $defaults = $this->getDefaults($type);
            $dataView = new DataView();
            $dataView->setType($type)
                ->setTitle($defaults['title'])
                ->setGridlist($defaults['gridlist'])
                ->setSearchProbs($defaults['searchProbs'])
                ->setUser($user)
                ->setCreateAt(new \DateTimeImmutable())
                ->setUpdateAt(new \DateTimeImmutable());
            $this->em->persist($dataView);
            $this->em->flush();
        }
        return $dataView;
    }
}
