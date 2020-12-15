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

class Badge
{
    private BadgeId $id;
    private BadgeTitle $title;
    private BadgeDescription $description;

    public function __construct(BadgeId $id, BadgeTitle $title, BadgeDescription $description)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
    }

    public function id(): BadgeId
    {
        return $this->id;
    }

    public function title(): BadgeTitle
    {
        return $this->title;
    }

    public function description(): BadgeDescription
    {
        return $this->description;
    }
}
