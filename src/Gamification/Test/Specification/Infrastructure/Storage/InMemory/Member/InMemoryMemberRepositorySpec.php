<?php

namespace Specification\Badger\Gamification\Infrastructure\Storage\InMemory\Member;

use Badger\Gamification\Domain\Member\MemberRepository;
use Badger\Gamification\Infrastructure\Storage\InMemory\Member\InMemoryMemberRepository;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class InMemoryMemberRepositorySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(InMemoryMemberRepository::class);
        $this->shouldImplement(MemberRepository::class);
    }
}
