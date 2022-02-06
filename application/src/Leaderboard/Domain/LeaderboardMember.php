<?php

namespace Badger\Leaderboard\Domain;

use Badger\Gamification\Domain\MemberBadges\MemberId;

class LeaderboardMember
{
    public MemberId $id;

    public function __construct(MemberId $id)
    {
        $this->id = $id;
    }

    public function id(): MemberId
    {
        return $this->id;
    }
}
