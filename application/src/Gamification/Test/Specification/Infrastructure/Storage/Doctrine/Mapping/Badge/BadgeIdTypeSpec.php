<?php

namespace Specification\Badger\Gamification\Infrastructure\Storage\Doctrine\Mapping\Badge;

use Badger\Gamification\Domain\Badge\BadgeId;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;
use PhpSpec\ObjectBehavior;
use Ramsey\Uuid\Uuid;

class BadgeIdTypeSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(StringType::class);
    }

    function it_should_return_a_name()
    {
        $this->getName()->shouldReturn('badge_id');
    }

    function it_should_convert_to_php_value(AbstractPlatform $platform)
    {
        $uuid = Uuid::uuid4();
        $badgeId = new BadgeId($uuid);

        $this->convertToPHPValue($uuid->toString(), $platform)->shouldBeLike($badgeId);
    }

    function it_should_convert_to_database_value(AbstractPlatform $platform)
    {
        $uuid = Uuid::uuid4();

        $this->convertToDatabaseValue($uuid->toString(), $platform)->shouldReturn($uuid->toString());
    }
}
