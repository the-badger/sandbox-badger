<?php

declare(strict_types=1);

namespace Badger\Gamification\Test\EndToEnd\Api\Context;

use Badger\Gamification\Domain\MemberBadges\MemberBadges;
use Badger\Gamification\Domain\MemberBadges\MemberId;
use Badger\Gamification\Domain\MemberBadges\MemberBadgesRepository;
use Behat\Behat\Context\Context;

final class AuthenticationContext implements Context
{
    private MemberBadgesRepository $memberRepository;

    public function __construct(MemberBadgesRepository $memberRepository)
    {
        $this->memberRepository = $memberRepository;
    }

    /**
     * @Given a badger :role :badgerMember
     */
    public function aBadgeMember(string $role, string $badgeMember): bool
    {
        $this->memberRepository->save(new MemberBadges(MemberId::fromUuidString('285bc91b-8416-4159-bf7a-b00144298f72'), MemberName::fromString($badgeMember)));

        return true;
    }
}
