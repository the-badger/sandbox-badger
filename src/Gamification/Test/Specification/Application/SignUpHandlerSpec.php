<?php

namespace Specification\Badger\Gamification\Application;

use Badger\Gamification\Application\SignUpHandler;
use Badger\Gamification\Domain\Member\MemberRepository;
use Badger\SharedSpace\Bus\CommandHandler;
use PhpSpec\ObjectBehavior;

class SignUpHandlerSpec extends ObjectBehavior
{
    public function it_is_initializable(MemberRepository $memberRepository)
    {
        $this->beConstructedWith($memberRepository);
        $this->shouldBeAnInstanceOf(SignUpHandler::class);
        $this->shouldImplement(CommandHandler::class);
    }
}
