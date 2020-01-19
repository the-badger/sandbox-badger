<?php

namespace Specification\Badger\Gamification\Domain\Badge;

use Badger\Gamification\Domain\Badge\EmptyBadgeTitleException;
use PhpSpec\ObjectBehavior;

class EmptyBadgeTitleExceptionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(EmptyBadgeTitleException::class);
        $this->beAnInstanceOf(\InvalidArgumentException::class);
    }
}
