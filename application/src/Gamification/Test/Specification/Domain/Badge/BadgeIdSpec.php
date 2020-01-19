<?php

namespace Specification\Badger\Gamification\Domain\Badge;

use Badger\Gamification\Domain\Badge\BadgeId;
use PhpSpec\ObjectBehavior;
use Ramsey\Uuid\Uuid;

class BadgeIdSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->beConstructedWith(Uuid::uuid4());
        $this->shouldHaveType(BadgeId::class);
    }
}
