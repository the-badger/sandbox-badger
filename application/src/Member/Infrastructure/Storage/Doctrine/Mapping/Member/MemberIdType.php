<?php

declare(strict_types=1);

namespace Badger\Member\Infrastructure\Storage\Doctrine\Mapping\Member;

use Badger\Member\Domain\Member\MemberId;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;
use Ramsey\Uuid\Uuid;

final class MemberIdType extends StringType
{
    public const NAME = 'member_id';

    public function getName(): string
    {
        return MemberIdType::NAME;
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
