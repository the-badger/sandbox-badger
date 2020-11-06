<?php

namespace Specification\Badger\Gamification\Infrastructure\Storage\Doctrine\Mapping\Member;

use Badger\Gamification\Domain\Member\MemberName;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;
use PhpSpec\ObjectBehavior;

class MemberNameTypeSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(StringType::class);
    }

    function it_should_return_a_name()
    {
        $this->getName()->shouldReturn('member_name');
    }

    function it_should_convert_to_php_value(AbstractPlatform $platform)
    {
        $memberName = MemberName::fromString('Michel');

        $this->convertToPHPValue('Michel', $platform)->shouldBeLike($memberName);
    }

    function it_should_convert_to_database_value(AbstractPlatform $platform)
    {
        $this->convertToDatabaseValue('Michel', $platform)->shouldReturn('Michel');
    }
}
