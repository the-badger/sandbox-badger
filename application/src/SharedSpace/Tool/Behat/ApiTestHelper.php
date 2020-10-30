<?php

declare(strict_types=1);

namespace Badger\SharedSpace\Tool\Behat;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\FileBag;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Routing\RouterInterface;

final class ApiTestHelper
{
    private KernelInterface $kernel;
    private RouterInterface $router;

    public function __construct(KernelInterface $kernel, RouterInterface $router)
    {
        $this->kernel = $kernel;
        $this->router = $router;
    }

    public function jsonPost(array $content, string $routeName, array $parameters = []): JsonResponse
    {
        return $this->query($content, $routeName, 'POST', $parameters);
    }

    public function jsonGet(array $content, string $routeName, array $parameters = []): JsonResponse
    {
        return $this->query($content, $routeName, 'GET', $parameters);
    }

    private function query(array $content, string $routeName, string $method, array $parameters = []): JsonResponse
    {
        $request = Request::create(
            $this->router->generate($routeName, $parameters),
            $method,
            [],
            [],
            [],
            [],
            \Safe\json_encode($content)
        );

        $request->attributes = new ParameterBag($content);

        if (array_key_exists('file', $content)) {
            $request->files = new FileBag(['file' => new UploadedFile($content['file'], $content['filename'])]);
        }

        return $this->kernel->handle(
            $request
        );
    }
}
