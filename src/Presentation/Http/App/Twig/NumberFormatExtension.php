<?php

declare(strict_types=1);

namespace App\Presentation\Http\App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class NumberFormatExtension extends AbstractExtension
{
    public function getFunctions()
    {
        return [
            new TwigFunction('number_format', [$this, 'format'], ['is_safe' => ['html']]),
        ];
    }

    public function format(?int $n): string|false
    {
        if(is_null($n))
        {
            return false;
        }

        $k = (int) log($n, 1000);
        $float = round($n / pow(1000, $k), 1);
        $letters = ['К', 'М', 'B'];

        return $float . ($letters[--$k] ?? '');
    }

}
