<?php

namespace Specification\Badger\Gamification\Application;

use Badger\Gamification\Application\InvalidBadgerMemberNameException;
use PhpSpec\ObjectBehavior;

class InvalidBadgerMemberNameExceptionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->beConstructedWith(1);
        $this->shouldHaveType(InvalidBadgerMemberNameException::class);
    }
}
