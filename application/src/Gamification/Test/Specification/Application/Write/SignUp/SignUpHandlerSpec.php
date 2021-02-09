<?php

namespace Specification\Badger\Gamification\Application\Write\SignUp;

use Badger\Gamification\Application\Write\SignUp\SignUp;
use Badger\Gamification\Application\Write\SignUp\SignUpHandler;
use Badger\Gamification\Domain\Member\Member;
use Badger\Gamification\Domain\Member\MemberId;
use Badger\Gamification\Domain\Member\MemberName;
use Badger\Gamification\Domain\Member\MemberRepository;
use Badger\SharedSpace\Bus\Command\CommandHandler;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Ramsey\Uuid\Uuid;

class SignUpHandlerSpec extends ObjectBehavior
{
    public function let(MemberRepository $memberRepository)
    {
        $this->beConstructedWith($memberRepository);
    }

    public function it_is_initializable()
    {
        $this->shouldBeAnInstanceOf(SignUpHandler::class);
        $this->shouldImplement(CommandHandler::class);
    }

    public function it_signs_up_a_member(MemberRepository $memberRepository)
    {
        $signUp = new SignUp();
        $signUp->badgerUserName = 'michel';

        $memberRepository->save(Argument::type(Member::class))->shouldBeCalled();

        $this->__invoke($signUp);
    }
}
