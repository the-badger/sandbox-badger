<?php

namespace Specification\Badger\Gamification\Application;

use Badger\Gamification\Application\NotEmptyMemberIdException;
use PhpSpec\ObjectBehavior;

class NotEmptyMemberIdExceptionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(NotEmptyMemberIdException::class);
    }
}
