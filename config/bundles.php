<?php

return [
    Symfony\Bundle\FrameworkBundle\FrameworkBundle::class => ['all' => true],
    FriendsOfBehat\SymfonyExtension\Bundle\FriendsOfBehatSymfonyExtensionBundle::class => ['test_in_memory' => true],
    SimpleBus\SymfonyBridge\SimpleBusCommandBusBundle::class => ['all' => true],
    SimpleBus\SymfonyBridge\SimpleBusEventBusBundle::class => ['all' => true],
];
