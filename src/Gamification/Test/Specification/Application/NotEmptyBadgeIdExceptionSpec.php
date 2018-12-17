<?php

namespace Specification\Badger\Gamification\Application;

use Badger\Gamification\Application\NotEmptyBadgeIdException;
use PhpSpec\ObjectBehavior;

class NotEmptyBadgeIdExceptionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(NotEmptyBadgeIdException::class);
    }
}
