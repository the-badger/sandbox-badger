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
use Badger\Gamification\Domain\Badge\BadgeTitle;
use Badger\Gamification\Domain\Badge\MaybeBadge\BadgeOption;

class InMemoryBadgeRepository implements BadgeRepository
{
    /** @var Badge[] */
    private array $badges = [];

    public function save(Badge $badge): void
    {
        $this->badges[$badge->id()->__toString()] = $badge;
    }

    public function get(BadgeId $badgeId): BadgeOption
    {
        return BadgeOption::fromValue($this->badges[(string) $badgeId]);
    }

    public function count(): int
    {
        return count($this->badges);
    }

    public function getBadgeByTitle(BadgeTitle $badgeTitle): BadgeOption
    {
        $badges = array_filter($this->badges, function (Badge $badge) use ($badgeTitle): bool {
            return $badge->title()->equals($badgeTitle);
        });

        if (0 === count($badges)) {
            return BadgeOption::none();
        }

        $badgeKey = array_key_first($badges);

        $badge = $this->badges[$badgeKey];

        return BadgeOption::some($badge);
    }

    public function all(): array
    {
        return $this->badges;
    }
}
