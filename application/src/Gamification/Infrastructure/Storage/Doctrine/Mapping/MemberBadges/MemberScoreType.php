<?php

declare(strict_types=1);

namespace Badger\Gamification\Infrastructure\Storage\Doctrine\Mapping\MemberBadges;

use Badger\Gamification\Domain\MemberBadges\MemberScore;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\IntegerType;

final class MemberScoreType extends IntegerType
{
    public const NAME = 'member_score';

    public function getName(): string
    {
        return static::NAME;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return MemberScore::fromInt($value);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if (null === $value) {
            return null;
        }

        return $value->get();
    }
}
