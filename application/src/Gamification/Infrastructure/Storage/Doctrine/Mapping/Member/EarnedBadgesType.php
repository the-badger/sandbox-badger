<?php

declare(strict_types=1);

namespace Badger\Gamification\Infrastructure\Storage\Doctrine\Mapping\Member;

use Badger\Gamification\Domain\Badge\BadgeId;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\JsonType;
use Phunkie\Types\ImmSet;

final class EarnedBadgesType extends JsonType
{
    public const NAME = 'earned_badges';

    public function getName(): string
    {
        return EarnedBadgesType::NAME;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): ImmSet
    {
        $values = \Safe\json_decode($value, true);

        $results = [];
        foreach ($values as $badgeId) {
            $results[] = BadgeId::fromUuidString($badgeId);
        }

        return new ImmSet(...$results);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        $values = [];
        $badgeIds = $value->iterator();
        foreach ($badgeIds as $badeId) {
            $values[] = $badeId->__toString();
        }

        return \Safe\json_encode($values);
    }
}
