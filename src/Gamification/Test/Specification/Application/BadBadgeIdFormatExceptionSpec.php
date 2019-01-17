<?php

namespace Specification\Badger\Gamification\Application;

use Badger\Gamification\Application\BadBadgeIdFormatException;
use PhpSpec\ObjectBehavior;
use Ramsey\Uuid\Uuid;

class BadBadgeIdFormatExceptionSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(Uuid::uuid5(Uuid::NAMESPACE_DNS, 'my_name_is_michel'));
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(BadBadgeIdFormatException::class);
    }
}
