<?php

namespace Specification\Badger\Gamification\Domain\Badge;

use Badger\Gamification\Domain\Badge\BadgeTitle;
use Badger\Gamification\Domain\Badge\EmptyBadgeTitleException;
use PhpSpec\ObjectBehavior;

class BadgeTitleSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->beConstructedWith("My awesome title");
        $this->shouldHaveType(BadgeTitle::class);
    }

    function it_cannot_exist_if_title_is_empty()
    {
        $this->shouldThrow(new EmptyBadgeTitleException())->during('__construct', ['']);
    }
}
