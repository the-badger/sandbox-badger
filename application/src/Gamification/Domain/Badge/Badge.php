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

namespace Badger\Gamification\Domain\Badge;

final class Badge
{
    private BadgeId $id;
    private BadgeTitle $title;

    public function __construct(BadgeId $id, BadgeTitle $title)
    {
        $this->id = $id;
        $this->title = $title;
    }

    public function id(): BadgeId
    {
        return $this->id;
    }

    public function title(): BadgeTitle
    {
        return $this->title;
    }
}
