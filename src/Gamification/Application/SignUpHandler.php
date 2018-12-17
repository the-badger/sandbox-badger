<?php

namespace Badger\Gamification\Application;

use Badger\Gamification\Domain\Member\Member;
use Badger\Gamification\Domain\Member\MemberRepository;
use Badger\SharedSpace\Bus\CommandHandler;

final class SignUpHandler implements CommandHandler
{
    /** @var MemberRepository */
    private $memberRepository;

    public function __construct(MemberRepository $memberRepository)
    {
        $this->memberRepository = $memberRepository;
    }

    public function __invoke(SignUp $signUp): void
    {
        $identity = $this->memberRepository->nextIdentity();

        $member = new Member($identity, $signUp->badgerUserName);

        $this->memberRepository->save($member);
    }
}
