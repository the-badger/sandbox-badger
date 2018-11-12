<?php

namespace Specification\Badger\Gamification\Domain\Member;

use Badger\Gamification\Domain\Member\MemberId;
use PhpSpec\ObjectBehavior;
use Ramsey\Uuid\Uuid;

class MemberIdSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->beConstructedWith(Uuid::uuid4());
        $this->shouldHaveType(MemberId::class);
    }
}
