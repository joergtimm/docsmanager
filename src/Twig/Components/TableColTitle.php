<?php

namespace App\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
final class TableColTitle
{
    public string $routename;

    public string $fieldname;

    public ?string $direction = 'asc';

    public string $label;

}
