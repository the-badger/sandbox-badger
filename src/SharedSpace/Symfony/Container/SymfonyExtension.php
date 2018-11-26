<?php

declare(strict_types=1);

namespace Badger\SharedSpace\Symfony\Container;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;

final class SymfonyExtension implements ExtensionInterface
{
    /** @var BoundedContextExtension */
    private $extension;

    /**
     * @param BoundedContextExtension $extension
     */
    public function __construct(BoundedContextExtension $extension)
    {
        $this->extension = $extension;
    }

    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container): void
    {
    }

    /**
     * {@inheritdoc}
     */
    public function getXsdValidationBasePath(): bool
    {
        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function getNamespace(): string
    {
        return 'http://example.org/schema/dic/'.$this->getAlias();
    }

    /**
     * {@inheritdoc}
     */
    public function getAlias(): string
    {
        return $this->extension->boundedContextName();
    }
}
