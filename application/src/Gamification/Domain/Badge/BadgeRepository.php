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

namespace Badger\Gamification\Domain\Badge;

use Badger\Gamification\Domain\Badge\MaybeBadge\BadgeOption;

interface BadgeRepository
{
    public function save(Badge $badge): void;

    public function get(BadgeId $badgeId): BadgeOption;

    public function getBadgeByTitle(BadgeTitle $badgeTitle): BadgeOption;

    public function count(): int;

    /** array<Badge> */
    public function all(): array;
}
