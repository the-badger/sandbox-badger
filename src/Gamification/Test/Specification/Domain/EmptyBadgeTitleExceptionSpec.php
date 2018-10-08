<?php

namespace Specification\Badger\Gamification\Domain;

use Badger\Gamification\Domain\EmptyBadgeTitleException;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class EmptyBadgeTitleExceptionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(EmptyBadgeTitleException::class);
        $this->beAnInstanceOf(\InvalidArgumentException::class);
    }
}
