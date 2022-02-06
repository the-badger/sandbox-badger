<?php

declare(strict_types=1);

namespace Badger\Gamification\Infrastructure\Storage\Doctrine\Mapping\MemberBadges;

use Badger\Gamification\Domain\MemberBadges\MemberId;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;
use Ramsey\Uuid\Uuid;

final class MemberIdType extends StringType
{
    public const NAME = 'member_id';

    public function getName(): string
    {
        return static::NAME;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return new MemberId(Uuid::fromString($value));
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if (null === $value) {
            return null;
        }

        return $value;
    }
}
