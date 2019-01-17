<?php

namespace Specification\Badger\Gamification\Application;

use Badger\Gamification\Application\ClaimABadge;
use PhpSpec\ObjectBehavior;

class ClaimABadgeSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->beConstructedWith('memberId', 'badgeId');
        $this->shouldHaveType(ClaimABadge::class);
    }
}
