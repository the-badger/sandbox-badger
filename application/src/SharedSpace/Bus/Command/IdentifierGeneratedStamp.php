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

use Symfony\Component\Messenger\Stamp\StampInterface;
use Ramsey\Uuid\UuidInterface;

final class IdentifierGeneratedStamp implements StampInterface
{
    /** @var UuidInterface */
    private $uuid;

    public function __construct(UuidInterface $uuid)
    {
        $this->uuid = $uuid;
    }

    public function uuid(): UuidInterface
    {
        return $this->uuid;
    }
}
