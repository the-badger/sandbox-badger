<?php

namespace Specification\Badger\Gamification\Domain\Member;

use Badger\Gamification\Domain\Member\Member;
use Badger\Gamification\Domain\Member\MemberId;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Ramsey\Uuid\Uuid;

class MemberSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(new MemberId(Uuid::uuid5(Uuid::NAMESPACE_DNS, 'a_name')), 'a_name');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Member::class);
    }

    function it_has_an_id()
    {
        $this->id()->shouldBeAMemberId();
    }

    function getMatchers(): array
    {
        return [
            'beAMemberId' => function ($subject) {
                return get_class($subject) === MemberId::class;
            }
        ];
    }
}
