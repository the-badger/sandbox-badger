<?php

namespace Specification\Badger\Gamification\Application\Write\AcceptABadge;

use Badger\Gamification\Application\Write\AcceptABadge\AcceptABadge;
use Innmind\BlackBox\PHPUnit\BlackBox;
use Innmind\BlackBox\Set\Uuid;
use PhpSpec\ObjectBehavior;

class AcceptABadgeSpec extends ObjectBehavior
{
    use BlackBox;

    function it_is_initializable()
    {
        $this->shouldHaveType(AcceptABadge::class);
    }

    function it_needs_properties()
    {
        $this
            ->forAll(Uuid::any(), Uuid::any())
            ->take(1)
            ->then(function (string $memberId, string $badgeId) {
                $this->memberId = $memberId;
                $this->badgeId = $badgeId;
            });
    }
}
