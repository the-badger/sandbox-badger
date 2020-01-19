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

namespace Badger\Gamification\Domain\Member;

use Badger\SharedSpace\ValueObject\StringObject;
use Webmozart\Assert\Assert;

final class MemberName extends StringObject
{
    public function validate(string $value): void
    {
        try {
            Assert::lengthBetween($value, 2, 255);
        } catch (\InvalidArgumentException $exception) {
            throw new InvalidBadgerMemberNameException(strlen($value));
        }
    }
}
