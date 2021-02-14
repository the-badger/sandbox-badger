<?php

namespace Specification\Badger\Gamification\Application\Write\RefuseABadge;

use Badger\Gamification\Application\Write\RefuseABadge\RefuseABadge;
use Innmind\BlackBox\PHPUnit\BlackBox;
use Innmind\BlackBox\Set\Uuid;
use PhpSpec\ObjectBehavior;

class RefuseABadgeSpec extends ObjectBehavior
{
    use BlackBox;

    function it_is_initializable()
    {
        $this->shouldHaveType(RefuseABadge::class);
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
