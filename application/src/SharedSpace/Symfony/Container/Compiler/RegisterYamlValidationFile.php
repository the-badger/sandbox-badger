<?php

/*
 * This file is part of the Badger package
 *
 * (c) Olivier Soulet & Anael Chardan
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Badger\SharedSpace\Symfony\Container\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Finder\Finder;

final class RegisterYamlValidationFile implements CompilerPassInterface
{
    private string $boundedContextPath;

    public function __construct(string $boundedContextPath)
    {
        $this->boundedContextPath = $boundedContextPath;
    }

    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container): void
    {
        $applicationDirectory = sprintf('%s/Application', $this->boundedContextPath);
        if (!is_dir($applicationDirectory)) {
            return;
        }

        /** @var \SplFileInfo[] $mappingFiles */
        $mappingFiles = Finder::create()->files()->in($applicationDirectory)->name('*.yaml');

        $validationFiles = [];

        /** @var \SplFileInfo $file */
        foreach ($mappingFiles as $file) {
            $validationFiles[] = $file->getPathname();
        }

        $container->getDefinition('validator.builder')->addMethodCall(
            'addYamlMappings',
            [$validationFiles]
        );
    }
}
