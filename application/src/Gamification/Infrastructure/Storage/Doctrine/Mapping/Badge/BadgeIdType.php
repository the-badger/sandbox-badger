<?php

declare(strict_types=1);

namespace Badger\Gamification\Infrastructure\Storage\Doctrine\Mapping\Badge;

use Badger\Gamification\Domain\Badge\BadgeId;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;
use Ramsey\Uuid\Uuid;

final class BadgeIdType extends StringType
{
    public const NAME = 'badge_id';

    public function getName(): string
    {
        return static::NAME;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return new BadgeId(Uuid::fromString($value));
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if (null === $value) {
            return null;
        }

        return $value;
    }
}
