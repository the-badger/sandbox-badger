<?php

namespace Specification\Badger\Gamification\Application\Write\ClaimABadge;

use Badger\Gamification\Application\Write\ClaimABadge\ClaimABadge;
use Innmind\BlackBox\PHPUnit\BlackBox;
use Innmind\BlackBox\Set\Uuid;
use PhpSpec\ObjectBehavior;

class ClaimABadgeSpec extends ObjectBehavior
{
    use BlackBox;

    function it_is_initializable()
    {
        $this->shouldHaveType(ClaimABadge::class);
    }

    function it_needs_properties()
    {
        $this
            ->forAll(Uuid::any(), Uuid::any(), Uuid::any())
            ->take(1)
            ->then(function (string $identifier, string $memberId, string $badgeId) {
                $this->identifier = $identifier;
                $this->memberId = $memberId;
                $this->badgeId = $badgeId;
            });
    }
}
