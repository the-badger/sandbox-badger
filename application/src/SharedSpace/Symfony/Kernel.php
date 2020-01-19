<?php

namespace Badger\SharedSpace\Symfony;

use Badger\Gamification\Infrastructure\Symfony\GamificationContainerExtension;
use Badger\SharedSpace\Symfony\Container\BoundedContextExtension;
use Badger\SharedSpace\Symfony\Container\Compiler\RegisterYamlValidationFile;
use Badger\SharedSpace\Symfony\Container\SymfonyExtension;
use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;
use Symfony\Component\Routing\RouteCollectionBuilder;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    const CONFIG_EXTS = '.{php,xml,yaml,yml}';

    public function getCacheDir()
    {
        return $this->getProjectDir().'/var/cache/'.$this->environment;
    }

    public function getLogDir()
    {
        return $this->getProjectDir().'/var/log';
    }

    public function registerBundles()
    {
        $contents = require $this->getProjectDir().'/config/bundles.php';
        foreach ($contents as $class => $envs) {
            if (isset($envs['all']) || isset($envs[$this->environment])) {
                yield new $class();
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function configureContainer(ContainerBuilder $container, LoaderInterface $loader): void
    {
        $container->setParameter('container.dumper.inline_class_loader', true);

        foreach ($this->registeredBoundedContext() as $boundedContextClassName) {
            $this->configureBoundedContext($boundedContextClassName, $container);
        }

        $confDir = $this->getProjectPath('config');
        $loader->load($confDir.'/services/default/**/*'.self::CONFIG_EXTS, 'glob');
        $loader->load($confDir.'/services/'.$this->environment.'/**/*'.self::CONFIG_EXTS, 'glob');

        $loader->load($confDir.'/{packages}/*'.self::CONFIG_EXTS, 'glob');
        $loader->load($confDir.'/{packages}/'.$this->environment.'/**/*'.self::CONFIG_EXTS, 'glob');
    }

    protected function configureRoutes(RouteCollectionBuilder $routes)
    {
        $confDir = $this->getProjectDir().'/config';

        $routes->import($confDir.'/{routes}/*'.self::CONFIG_EXTS, '/', 'glob');
        $routes->import($confDir.'/{routes}/'.$this->environment.'/**/*'.self::CONFIG_EXTS, '/', 'glob');
        $routes->import($confDir.'/{routes}'.self::CONFIG_EXTS, '/', 'glob');
    }

    private function configureBoundedContext(BoundedContextExtension $boundedContext, ContainerBuilder $containerBuilder): void
    {
        $containerBuilder->registerExtension(new SymfonyExtension($boundedContext));
        $containerBuilder->addCompilerPass(new RegisterYamlValidationFile($boundedContext->path()));
    }

    /**
     * @param string|null $extraPath
     *
     * @return string
     */
    private function getProjectPath(string $extraPath = null): string
    {
        $path = $this->getProjectDir().'/';

        if (null !== $extraPath) {
            $path .= $extraPath;
        }

        return $path;
    }

    /**
     * @return string[]
     */
    private function registeredBoundedContext(): array
    {
        return [
            new GamificationContainerExtension(),
        ];
    }
}
