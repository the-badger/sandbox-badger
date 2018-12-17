<?php

namespace Specification\Badger\Gamification\Application;

use Badger\Gamification\Application\SignUp;
use Badger\Gamification\Application\SignUpHandler;
use Badger\Gamification\Domain\Member\Member;
use Badger\Gamification\Domain\Member\MemberId;
use Badger\Gamification\Domain\Member\MemberRepository;
use Badger\SharedSpace\Bus\CommandHandler;
use PhpSpec\ObjectBehavior;
use Ramsey\Uuid\Uuid;

class SignUpHandlerSpec extends ObjectBehavior
{
    public function let(MemberRepository $memberRepository)
    {
        $this->beConstructedWith($memberRepository);
    }

    public function it_is_initializable(MemberRepository $memberRepository)
    {
        $this->shouldBeAnInstanceOf(SignUpHandler::class);
        $this->shouldImplement(CommandHandler::class);
    }

    public function it_signs_up_a_member($memberRepository)
    {
        $signUp = new SignUp('michel');
        $memberId = new MemberId(Uuid::uuid5(Uuid::NAMESPACE_DNS, 'michel'));
        $memberRepository->nextIdentity()->willReturn($memberId);
        $member = new Member($memberId, 'michel');
        $memberRepository->save($member)->shouldBeCalled();

        $this->__invoke($signUp);
    }
}
