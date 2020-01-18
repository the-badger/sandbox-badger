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

namespace Badger\Gamification\Domain\Badge\MaybeBadge;

use Phunkie\Types\Option;

class BadgeOption
{
    /** @var Option */
    private $option;

    public function __construct(Option $option)
    {
        $this->option = $option;
    }

    public function option(): Option
    {
        return $this->option;
    }

    public function __invoke(): Option
    {
        return $this->option;
    }
}
