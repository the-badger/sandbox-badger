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

use Badger\SharedSpace\ValueObject\StringObject;
use Webmozart\Assert\Assert;

final class BadgeDescription extends StringObject
{
    public function validate(string $value): void
    {
        try {
            Assert::stringNotEmpty($value);
        } catch (\InvalidArgumentException $e) {
            throw new EmptyBadgeDescriptionException();
        }
    }
}
