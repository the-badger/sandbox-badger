<?php

namespace Specification\Badger\Gamification\Infrastructure\Storage\Doctrine\Mapping\MemberBadges;

use Badger\Gamification\Domain\MemberBadges\MemberId;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;
use PhpSpec\ObjectBehavior;
use Ramsey\Uuid\Uuid;

class MemberIdTypeSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(StringType::class);
    }

    function it_should_return_a_name()
    {
        $this->getName()->shouldReturn('member_id');
    }

    function it_should_convert_to_php_value(AbstractPlatform $platform)
    {
        $uuid = Uuid::uuid4();
        $memberId = new MemberId($uuid);

        $this->convertToPHPValue($uuid->toString(), $platform)->shouldBeLike($memberId);
    }

    function it_should_convert_to_database_value(AbstractPlatform $platform)
    {
        $uuid = Uuid::uuid4();

        $this->convertToDatabaseValue($uuid->toString(), $platform)->shouldReturn($uuid->toString());
    }
}
