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
use Webmozart\Assert\Assert;

final class ClaimABadge implements Command
{
    /** @var string */
    public $memberId;

    /** @var string */
    private $badgeId;

    public function __construct(string $memberId, string $badgeId)
    {
        try {
            Assert::notEmpty($memberId);
        } catch (\InvalidArgumentException $exception) {
            throw new NotEmptyMemberIdException();
        }

        try {
            Assert::notEmpty($badgeId);
        } catch (\InvalidArgumentException $exception) {
            throw new NotEmptyBadgeIdException();
        }

        $this->memberId = $memberId;
        $this->badgeId = $badgeId;
    }
}
