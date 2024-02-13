<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new TwigFunction('create_button', [$this, 'createButton']),
        ];
    }

    public function createButton(string $id, string $classes, string $stimulus_target, string $svg, string $text): string
    {
        return sprintf("
<button
    class=\"%s\"
    id=\"%s\"
%s
>
<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" 
fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" 
class=\"fill-current w-4 h-4 mr-2\">
    %s
</svg>
<span>%s</span>
</button>", $classes, $id, $stimulus_target, $svg, $text);
    }
}
