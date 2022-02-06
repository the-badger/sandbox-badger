<?php

declare(strict_types=1);

namespace Badger\Gamification\Infrastructure\Storage\Doctrine\Mapping\Badge;

use Badger\Gamification\Domain\Badge\BadgeScore;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\IntegerType;

final class BadgeScoreType extends IntegerType
{
    public const NAME = 'badge_score';

    public function getName(): string
    {
        return BadgeScoreType::NAME;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return BadgeScore::fromInt($value);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if (null === $value) {
            return null;
        }

        return $value->get();
    }
}
