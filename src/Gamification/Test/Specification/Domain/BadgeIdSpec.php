<?php

namespace Specification\Badger\Gamification\Domain;

use Badger\Gamification\Domain\BadgeId;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Ramsey\Uuid\Uuid;

class BadgeIdSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->beConstructedWith(Uuid::uuid4());
        $this->shouldHaveType(BadgeId::class);
    }
}
