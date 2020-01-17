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

use Badger\SharedSpace\Bus\Command;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Middleware\MiddlewareInterface;
use Symfony\Component\Messenger\Middleware\StackInterface;
use Webmozart\Assert\Assert;

final class IdentifierMiddleware implements MiddlewareInterface
{
    public function handle(Envelope $envelope, StackInterface $stack): Envelope
    {
        /** @var Command $command */
        $command = $envelope->getMessage();

        $identifier = $command->identifierName();

        $lastIdentifierGeneratedStampHasNotBeenGenerated = null === $envelope->last(IdentifierGeneratedStamp::class);
        if ($lastIdentifierGeneratedStampHasNotBeenGenerated) {
            if (null === $command->$identifier) {
                $uuid = Uuid::uuid4();
                $command->$identifier = $uuid->toString();
                $envelope = $envelope->with(new IdentifierGeneratedStamp($uuid));
            } else {
                Assert::string($command->$identifier);
                $identifier = (string) $command->$identifier;
                Assert::uuid((string) $identifier);
                $uuid = Uuid::fromString($identifier);
                $envelope = $envelope->with(new IdentifierGeneratedStamp($uuid));
            }
        }

        return $stack->next()->handle($envelope, $stack);
    }
}
