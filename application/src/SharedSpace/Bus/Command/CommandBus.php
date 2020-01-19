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

namespace Badger\SharedSpace\Bus\Command;

use Badger\SharedSpace\Bus\Command\Command;
use Badger\SharedSpace\Bus\Command\IdentifierGeneratedStamp;
use Ramsey\Uuid\UuidInterface;
use Symfony\Component\Messenger\MessageBusInterface;

/**
 * Not final for testing purpose
 * Adapt Symfony Messenger because dispatch returns an Envelope marked as final.
 */
class CommandBus
{
    /** @var MessageBusInterface */
    private $commandBus;

    public function __construct(MessageBusInterface $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    /**
     * @final
     */
    public function dispatch(Command $command): UuidInterface
    {
        $envelope = $this->commandBus->dispatch($command);
        /** @var IdentifierGeneratedStamp|null $stamp */
        $stamp = $envelope->last(IdentifierGeneratedStamp::class);
        if (null !== $stamp) {
            return $stamp->uuid();
        }

        throw new \LogicException('Should have generated the identifier');
    }
}
