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

final class BadgePoints
{
    private const MAX = 50;
    private const MIN = 5;
    private int $numberOfPoints;

    private function __construct(int $numberOfPoints)
    {
        $this->validate($numberOfPoints);
        $this->numberOfPoints = $numberOfPoints;
    }

    public static function fromInt(int $numberOfPoints): self
    {
        return new BadgePoints($numberOfPoints);
    }

    public function get(): int
    {
        return $this->numberOfPoints;
    }

    public function validate(int $numberOfPoints): void
    {
        if ($numberOfPoints < self::MIN || $numberOfPoints > self::MAX) {
            throw new InvalidNumberOfPointsException();
        }
    }
}
