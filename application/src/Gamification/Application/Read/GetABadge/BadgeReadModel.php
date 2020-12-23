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

namespace Badger\Gamification\Application\Read\GetABadge;

use Badger\Gamification\Domain\Badge\Badge;
use Badger\SharedSpace\Bus\Query\ReadModel;

final class BadgeReadModel implements ReadModel
{
    public string $id;
    public string $title;
    public string $description;

    public function __construct(Badge $badge)
    {
        $this->id = $badge->id()->__toString();
        $this->title = $badge->title()->__toString();
        $this->description = $badge->description()->__toString();
    }
}
