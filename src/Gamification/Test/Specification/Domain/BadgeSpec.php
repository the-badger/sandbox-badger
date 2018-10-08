<?php

namespace Specification\Badger\Gamification\Domain;

use Badger\Gamification\Domain\Badge;
use Badger\Gamification\Domain\BadgeId;
use Badger\Gamification\Domain\BadgeTitle;
use PhpSpec\ObjectBehavior;
use Ramsey\Uuid\Uuid;

class BadgeSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->beConstructedWith(new BadgeId(Uuid::uuid4()), new BadgeTitle("My super badge name"));
        $this->shouldHaveType(Badge::class);
    }
}
