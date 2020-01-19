<?php

declare(strict_types=1);

namespace Badger\Gamification\Infrastructure\Symfony;

use Badger\SharedSpace\Symfony\Container\BoundedContextExtension;

final class GamificationContainerExtension implements BoundedContextExtension
{
    private const BOUNDED_CONTEXT_NAME = 'gamification';

    public function name(): string
    {
        return self::BOUNDED_CONTEXT_NAME;
    }

    /**
     * {@inheritdoc}
     */
    public function path(): string
    {
        return \sprintf('%s/../..', __DIR__);
    }
}
