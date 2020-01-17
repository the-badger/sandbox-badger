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

final class Badge
{
    /** @var BadgeId */
    private $id;
    /** @var BadgeTitle */
    private $title;

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
