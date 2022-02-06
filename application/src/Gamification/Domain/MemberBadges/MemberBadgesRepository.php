<?php

namespace Badger\Gamification\Domain\MemberBadges;

use Badger\Gamification\Domain\MemberBadges\MaybeMember\MemberOption;

interface MemberBadgesRepository
{
    public function save(MemberBadges $member): void;

    public function get(MemberId $memberId): MemberOption;
}
