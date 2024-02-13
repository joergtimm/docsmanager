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
