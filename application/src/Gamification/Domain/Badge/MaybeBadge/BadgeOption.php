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

use Badger\Gamification\Domain\Badge\Badge;
use Phunkie\Types\Option;
use Phunkie\Types\Some;

final class BadgeOption
{
    private Option $option;

    private function __construct(Option $option)
    {
        $this->option = $option;
    }

    public static function none(): BadgeOption
    {
        return self::fromValue(null);
    }

    public static function some(Badge $badge): BadgeOption
    {
        return self::fromValue($badge);
    }

    public static function fromValue(?Badge $badge): BadgeOption
    {
        return new static(\Option($badge));
    }

    public function isEmpty(): bool
    {
        return $this->option->isEmpty();
    }

    public function badge(): Badge
    {
        if ($this->option instanceof Some) {
            return $this->option->get();
        }

        throw new \RuntimeException('Nothing to get');
    }

    public function __invoke(): Option
    {
        return $this->option;
    }
}
