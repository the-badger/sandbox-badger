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

namespace Badger\Member\Domain\Member;

use Badger\Member\Domain\InvalidScoreException;

final class MemberScore
{
    private const MIN = 0;
    private int $score;

    private function __construct(int $score)
    {
        $this->validate($score);
        $this->score = $score;
    }

    public static function fromInt(int $score): self
    {
        return new MemberScore($score);
    }

    public function get(): int
    {
        return $this->score;
    }

    public function validate(int $score): void
    {
        if ($score < self::MIN) {
            throw new InvalidScoreException();
        }
    }
}
