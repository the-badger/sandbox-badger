<?php

namespace Specification\Badger\Gamification\Application;

use Badger\Gamification\Application\BadMemberIdFormatException;
use PhpSpec\ObjectBehavior;
use Ramsey\Uuid\Uuid;

class BadMemberIdFormatExceptionSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(Uuid::uuid5(Uuid::NAMESPACE_DNS, 'michel'));
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(BadMemberIdFormatException::class);
    }
}
