<?php

declare(strict_types=1);

namespace Badger\SharedSpace\Symfony\Container;


interface BoundedContextExtension
{
    /**
     * Returns the name of the bounded context.
     * It is used to activate the extension in the application container (config/my_trip.yml).
     *
     * @return MappedEntitySet
     */
    public function boundedContextName(): string;

    /**
     * Returns the the path to the root of the bounded context.
     *
     * @return string
     */
    public function boundedContextPath(): string;
}
