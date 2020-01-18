<?php

namespace Specification\Badger\Gamification\Application;

use Badger\Gamification\Application\InvalidBadgerMemberNameException;
use Badger\Gamification\Application\SignUp;
use PhpSpec\ObjectBehavior;

class SignUpSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->beConstructedWith('name');
        $this->shouldHaveType(SignUp::class);
    }

    function it_should_be_betwwen_2_and_255_caracters()
    {
        $this->shouldThrow(InvalidBadgerMemberNameException::class)->during('__construct', ['a']);
        $this->shouldThrow(InvalidBadgerMemberNameException::class)->during('__construct', ['']);
        $this->shouldNotThrow(InvalidBadgerMemberNameException::class)->during('__construct', ['ab']);
    }
}
