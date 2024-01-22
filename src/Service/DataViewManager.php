<?php

namespace App\Service;

use App\Entity\Client;
use App\Entity\User;
use App\Repository\UserSettingRepository;

class DataViewManager
{
    public function __construct(private UserSettingRepository $userSettingRepository)
    {
    }

    public function getClient(User $user): ?Client
    {
        $settings = $this->userSettingRepository->findOneBy(['user' => $user]);

        return $settings->getClientInUse();
    }
}
