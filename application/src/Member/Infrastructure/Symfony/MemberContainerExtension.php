<?php

declare(strict_types=1);

namespace Badger\Member\Infrastructure\Symfony;

use Badger\SharedSpace\Symfony\Container\BoundedContextExtension;

final class MemberContainerExtension implements BoundedContextExtension
{
    private const BOUNDED_CONTEXT_NAME = 'member';

    public function name(): string
    {
        return self::BOUNDED_CONTEXT_NAME;
    }

    public function path(): string
    {
        return \sprintf('%s/../..', __DIR__);
    }
}
