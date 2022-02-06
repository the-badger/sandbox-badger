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

use Badger\Gamification\Domain\InvalidScoreException;

final class BadgeScore
{
    private const MAX = 50;
    private const MIN = 5;
    private int $score;

    private function __construct(int $score)
    {
        $this->validate($score);
        $this->score = $score;
    }

    public static function fromInt(int $score): self
    {
        return new BadgeScore($score);
    }

    public function get(): int
    {
        return $this->score;
    }

    public function validate(int $score): void
    {
        if ($score < self::MIN || $score > self::MAX) {
            throw new InvalidScoreException();
        }
    }
}
