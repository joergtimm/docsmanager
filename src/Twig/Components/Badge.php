<?php

namespace App\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
class Badge
{
    public string $variant = 'default';

    public function getVariantClasses(): string
    {
        return match ($this->variant) {
            'default' => 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300',
            'dark' => 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300',
            'red' => 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-300',
            'green' => 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300',
            'yellow' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300',
            'indigo' => 'bg-indigo-100 text-indigo-800 dark:bg-indigo-900 dark:text-indigo-300',
            'purple' => 'bg-purple-100 text-purple-800 dark:bg-purple-900 dark:text-purple-300',
            'pink' => 'bg-pink-100 text-pink-800 dark:bg-pink-900 dark:text-pink-300',
            default => throw new \LogicException(sprintf('Unknown badge type "%s"', $this->variant)),
        };
    }
}
