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

use Badger\SharedSpace\Bus\Query\ReadModel;

final class BadgesReadModel implements ReadModel
{
    private array $badges = [];

    public function __construct(array $badges)
    {
        foreach ($badges as $badge) {
            $this->badges[] = [
                'id' => $badge->id()->__toString(),
                'title' => $badge->title()->__toString(),
                'description' => $badge->description()->__toString(),
            ];
        }
    }

    public function getValue(): array
    {
        return $this->badges;
    }
}
