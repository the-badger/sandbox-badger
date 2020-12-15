<?php

namespace Specification\Badger\Gamification\Infrastructure\Storage\Doctrine\Mapping\Badge;

use Badger\Gamification\Domain\Badge\BadgeTitle;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;
use PhpSpec\ObjectBehavior;

class BadgeTitleTypeSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(StringType::class);
    }

    function it_should_return_a_name()
    {
        $this->getName()->shouldReturn('badge_title');
    }

    function it_should_convert_to_php_value(AbstractPlatform $platform)
    {
        $badeTitle = BadgeTitle::fromString('My name is Michel and I am very proud!');

        $this->convertToPHPValue('My name is Michel and I am very proud!', $platform)->shouldBeLike($badeTitle);
    }

    function it_should_convert_to_database_value(AbstractPlatform $platform)
    {
        $this->convertToDatabaseValue('My name is Michel and I am very proud!', $platform)->shouldReturn('My name is Michel and I am very proud!');
    }
}
