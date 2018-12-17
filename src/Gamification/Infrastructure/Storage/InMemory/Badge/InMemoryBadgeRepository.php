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

namespace Badger\Gamification\Infrastructure\Storage\InMemory\Badge;

use Badger\Gamification\Domain\Badge\Badge;
use Badger\Gamification\Domain\Badge\BadgeId;
use Badger\Gamification\Domain\Badge\BadgeRepository;
use Badger\Gamification\Domain\Badge\MaybeBadge\BadgeOption;

class InMemoryBadgeRepository implements BadgeRepository
{
    /** @var Badge[] */
    private $badges = [];

    public function save(Badge $badge): void
    {
        $this->badges[$badge->id()->__toString()] = $badge;
    }

    public function get(BadgeId $badgeId): BadgeOption
    {
        return new BadgeOption(\Option($this->badges[$badgeId->__toString()]));
    }
}
