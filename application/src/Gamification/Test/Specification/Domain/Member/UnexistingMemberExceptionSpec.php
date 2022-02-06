<?php

namespace Specification\Badger\Gamification\Domain\Member;

use Badger\Gamification\Domain\MemberBadges\MemberId;
use Badger\Gamification\Domain\MemberBadges\NoMemberBadgesException;
use PhpSpec\ObjectBehavior;
use Ramsey\Uuid\Uuid;

class UnexistingMemberExceptionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->beConstructedWith(new MemberId(Uuid::uuid5(Uuid::NAMESPACE_DNS, 'michel')));
        $this->shouldHaveType(NoMemberBadgesException::class);
    }
}
