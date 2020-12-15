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

namespace Badger\Gamification\Infrastructure\Storage\Doctrine\Mapping\Badge;

use Badger\Gamification\Domain\Badge\BadgeDescription;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

final class BadgeDescriptionType extends StringType
{
    public const NAME = 'badge_description';

    public function getName(): string
    {
        return static::NAME;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return BadgeDescription::fromString($value);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value;
    }
}
