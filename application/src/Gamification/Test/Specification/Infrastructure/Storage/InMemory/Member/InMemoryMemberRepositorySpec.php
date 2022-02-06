<?php

namespace Specification\Badger\Gamification\Infrastructure\Storage\InMemory\Member;

use Badger\Gamification\Domain\MemberBadges\MemberBadgesRepository;
use Badger\Gamification\Infrastructure\Storage\InMemory\Member\InMemoryMemberBadgesRepository;
use PhpSpec\ObjectBehavior;

class InMemoryMemberRepositorySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(InMemoryMemberBadgesRepository::class);
        $this->shouldImplement(MemberBadgesRepository::class);
    }
}
