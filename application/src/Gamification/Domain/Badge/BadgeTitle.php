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

use Badger\SharedSpace\ValueObject\StringObject;
use Webmozart\Assert\Assert;

final class BadgeTitle extends StringObject
{
    public function validate(string $value): void
    {
        try {
            Assert::stringNotEmpty($value);
        } catch (\InvalidArgumentException $e) {
            throw new EmptyBadgeTitleException();
        }
    }
}
