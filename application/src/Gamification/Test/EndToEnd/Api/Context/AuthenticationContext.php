<?php

declare(strict_types=1);

namespace Badger\Gamification\Test\EndToEnd\Api\Context;

use Badger\Gamification\Domain\Member\Member;
use Badger\Gamification\Domain\Member\MemberId;
use Badger\Gamification\Domain\Member\MemberName;
use Badger\Gamification\Domain\Member\MemberRepository;
use Behat\Behat\Context\Context;

final class AuthenticationContext implements Context
{
    private MemberRepository $memberRepository;

    public function __construct(MemberRepository $memberRepository)
    {
        $this->memberRepository = $memberRepository;
    }

    /**
     * @Given a badger :role :badgerMember
     */
    public function aBadgeMember(string $role, string $badgeMember): bool
    {
        $this->memberRepository->save(new Member(MemberId::fromUuidString('285bc91b-8416-4159-bf7a-b00144298f72'), MemberName::fromString($badgeMember)));

        return true;
    }
}
