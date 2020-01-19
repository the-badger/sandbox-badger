<?php

namespace Specification\Badger\Gamification\Domain\Badge;

use Badger\Gamification\Domain\Badge\Badge;
use Badger\Gamification\Domain\Badge\BadgeId;
use Badger\Gamification\Domain\Badge\BadgeTitle;
use PhpSpec\ObjectBehavior;
use Ramsey\Uuid\Uuid;

class BadgeSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->beConstructedWith(new BadgeId(Uuid::uuid4()), BadgeTitle::fromString("My super badge name"));
        $this->shouldHaveType(Badge::class);
    }
}
