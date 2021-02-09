<?php

namespace Badger\Gamification\Application\Write\SignUp;

use Badger\Gamification\Domain\Member\Member;
use Badger\Gamification\Domain\Member\MemberId;
use Badger\Gamification\Domain\Member\MemberName;
use Badger\Gamification\Domain\Member\MemberRepository;
use Badger\SharedSpace\Bus\Command\CommandHandler;
use Ramsey\Uuid\Uuid;

final class SignUpHandler implements CommandHandler
{
    private MemberRepository $memberRepository;

    public function __construct(MemberRepository $memberRepository)
    {
        $this->memberRepository = $memberRepository;
    }

    public function __invoke(SignUp $signUp): void
    {
        $member = new Member(
            MemberId::fromUuidString(Uuid::uuid4()->toString()),
            MemberName::fromString($signUp->badgerUserName)
        );

        $this->memberRepository->save($member);
    }
}
