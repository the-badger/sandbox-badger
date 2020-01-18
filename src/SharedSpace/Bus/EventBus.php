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

namespace Badger\SharedSpace\Bus;

use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\DispatchAfterCurrentBusStamp;

/**
 * Not final for testing purpose
 * Adapt Symfony Messenger because dispatch returns an Envelope marked as final.
 */
class EventBus
{
    /** @var MessageBusInterface */
    private $eventBus;

    public function __construct(MessageBusInterface $eventBus)
    {
        $this->eventBus = $eventBus;
    }

    /**
     * @final
     */
    public function dispatch(Event $event): void
    {
        $this->eventBus->dispatch($event);
    }

    /**
     * @final
     */
    public function dispatchAfter(Event $event): void
    {
        $this
            ->eventBus
            ->dispatch(
                (new Envelope($event))->with(new DispatchAfterCurrentBusStamp())
            );
    }
}
