<?php

namespace Specification\Badger\Gamification\Application\Write\SignUp;

use Badger\Gamification\Domain\Member\InvalidBadgerMemberNameException;
use Badger\Gamification\Application\Write\SignUp\SignUp;
use PhpSpec\ObjectBehavior;

class SignUpSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->beConstructedWith('name');
        $this->shouldHaveType(SignUp::class);
    }
}
