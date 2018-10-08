<?php

$rootDirectory = sprintf('%s/../../..', __DIR__);
$contextDirectory = sprintf('%s/src/Gamification', $rootDirectory);

$finder = PhpCsFixer\Finder::create()
    ->exclude('Test/Specification')
    ->in($contextDirectory)
;

return PhpCsFixer\Config::create()
    ->setRules([
        '@Symfony' => true,
        'array_syntax' => ['syntax' => 'short'],
    ])
    ->setCacheFile(sprintf('%s/var/php_cs.cache', $rootDirectory))
    ->setFinder($finder)
;
