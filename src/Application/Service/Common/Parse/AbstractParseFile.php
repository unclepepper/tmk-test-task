<?php

declare(strict_types=1);

namespace App\Application\Service\Common\Parse;

use Exception;


abstract class AbstractParseFile
{

    protected array $data;

    public function __construct(
        protected string $path,
    ) {}

    /**
     * @return array<string, mixed>
     * @throws Exception
     */
    abstract public function parse(): array;

}
