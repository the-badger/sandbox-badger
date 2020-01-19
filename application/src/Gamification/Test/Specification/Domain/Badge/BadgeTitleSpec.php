<?php

namespace Specification\Badger\Gamification\Domain\Badge;

use Badger\Gamification\Domain\Badge\BadgeTitle;
use Badger\Gamification\Domain\Badge\EmptyBadgeTitleException;
use PhpSpec\ObjectBehavior;

class BadgeTitleSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->beConstructedThrough('fromString', ['My awesomeTitle']);
        $this->shouldHaveType(BadgeTitle::class);
    }

    function it_cannot_exist_if_title_is_empty()
    {
        $this->beConstructedThrough('fromString', ['']);
        $this->shouldThrow(new EmptyBadgeTitleException())->duringInstantiation();
    }
}
