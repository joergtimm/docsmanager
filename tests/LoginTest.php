<?php

namespace App\Tests;

use Symfony\Component\Panther\PantherTestCase;

class LoginTest extends PantherTestCase
{
    public function testSomethi(): void
    {

        $client = self::createPantherClient(
            [],
            [],
            [
                'capabilities' => [
                    'goog:loggingPrefs' => [
                        'browser' => 'ALL', // calls to console.* methods
                        'performance' => 'ALL', // performance data
                    ],
                ],
            ]
        );

        $client->request('GET', '/');
        $consoleLogs = $client->getWebDriver()->manage()->getLog('browser'); // console logs
        $performanceLogs = $client->getWebDriver()->manage()->getLog('performance');
    }
}
