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

namespace Badger\SharedSpace\ValueObject;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

abstract class Identifier
{
    protected UuidInterface $uuid;

    public function __construct(UuidInterface $uuid)
    {
        $this->uuid = $uuid;
    }

    public static function fromUuidString(string $uuid)
    {
        try {
            return new static(Uuid::fromString($uuid));
        } catch (\InvalidArgumentException $exception) {
            throw new \InvalidArgumentException('Expected a valid uuid for '.static::class, (int) $exception->getCode(), $exception);
        }
    }

    public function __toString(): string
    {
        return $this->uuid->toString();
    }

    public function equals(Identifier $identifier): bool
    {
        return $identifier->uuid->equals($this->uuid);
    }
}
