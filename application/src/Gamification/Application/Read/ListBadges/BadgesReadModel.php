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

namespace Badger\Gamification\Application\Read\ListBadges;

use Badger\Gamification\Domain\Badge\Badge;

final class BadgesReadModel
{
    /** @var array<Badge> */
    private array $badges = [];

    /** @var array<Badge> */
    public function __construct(array $badges)
    {
        foreach ($badges as $badge) {
            $this->$badges[] = [
                'id' => $badge->id()->toString(),
                'title' => $badge->title()->toString(),
                'description' => $badge->description()->toString(),
            ];
        }
    }
}
