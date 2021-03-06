<?php

namespace Specification\Badger\Gamification\Domain\Member;

use Badger\Gamification\Domain\Badge\BadgeId;
use Badger\Gamification\Domain\Badge\BadgeDoesNotExistException;
use PhpSpec\ObjectBehavior;
use Ramsey\Uuid\Uuid;

class UnexistingBadgeExceptionSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->beConstructedWith(new BadgeId(Uuid::uuid5(Uuid::NAMESPACE_DNS, 'my_name_is_michel')));
        $this->shouldHaveType(BadgeDoesNotExistException::class);
    }
}
