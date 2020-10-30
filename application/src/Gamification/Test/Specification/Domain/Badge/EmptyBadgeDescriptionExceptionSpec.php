<?php

namespace Specification\Badger\Gamification\Domain\Badge;

use Badger\Gamification\Domain\Badge\EmptyBadgeDescriptionException;
use PhpSpec\ObjectBehavior;

class EmptyBadgeDescriptionExceptionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(EmptyBadgeDescriptionException::class);
        $this->beAnInstanceOf(\InvalidArgumentException::class);
    }
}
