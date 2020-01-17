<?php

declare(strict_types=1);

/*
 * This file is part of the Badger package
 *
 * (c) Olivier Soulet & Anael Chardan
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Badger\Gamification\Application;

use Badger\SharedSpace\Bus\Command;
use Ramsey\Uuid\Exception\InvalidUuidStringException;
use Ramsey\Uuid\Uuid;
use Webmozart\Assert\Assert;

final class ClaimABadge implements Command
{
    /** @var string */
    public $identifier;

    /** @var string */
    public $memberId;

    /** @var string */
    public $badgeId;

    public function __construct(string $memberId, string $badgeId)
    {
        try {
            Assert::notEmpty($memberId);
            $this->memberId = Uuid::fromString($memberId);
        } catch (\InvalidArgumentException | InvalidUuidStringException $e) {
            throw new BadMemberIdFormatException($memberId);
        }

        try {
            Assert::notEmpty($badgeId);
            $this->badgeId = Uuid::fromString($badgeId);
        } catch (\InvalidArgumentException | InvalidUuidStringException $e) {
            throw new BadBadgeIdFormatException($badgeId);
        }
    }

    public function identifierName(): string
    {
        return 'identifier';
    }
}
