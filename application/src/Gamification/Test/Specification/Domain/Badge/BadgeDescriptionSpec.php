<?php

namespace Specification\Badger\Gamification\Domain\Badge;

use Badger\Gamification\Domain\Badge\BadgeDescription;
use Badger\Gamification\Domain\Badge\EmptyBadgeDescriptionException;
use PhpSpec\ObjectBehavior;

class BadgeDescriptionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->beConstructedThrough('fromString', ['My awesome description']);
        $this->shouldHaveType(BadgeDescription::class);
    }

    function it_cannot_exist_if_description_is_empty()
    {
        $this->beConstructedThrough('fromString', ['']);
        $this->shouldThrow(new EmptyBadgeDescriptionException())->duringInstantiation();
    }
}
