<?php

declare(strict_types=1);

namespace Badger\SharedSpace\Symfony\Container;


interface BoundedContextExtension
{
    public function name(): string;
    public function path(): string;
}
