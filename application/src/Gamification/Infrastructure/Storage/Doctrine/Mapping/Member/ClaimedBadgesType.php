<?php

declare(strict_types=1);

namespace Badger\Gamification\Infrastructure\Storage\Doctrine\Mapping\Member;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\JsonType;
use Phunkie\Types\ImmSet;

final class ClaimedBadgesType extends JsonType
{
    public const NAME = 'claimed_badges';

    public function getName(): string
    {
        return static::NAME;
    }

    public function convertToPHPValue($value, AbstractPlatform $platform): ImmSet
    {
        $value = \Safe\json_decode($value, true);

        return new ImmSet(...$value);
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return \Safe\json_encode($value);
    }
}
