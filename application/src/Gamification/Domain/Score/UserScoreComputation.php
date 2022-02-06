<?php

namespace Badger\Gamification\Domain\Score;

use Badger\Gamification\Domain\Badge\Badge;
use Badger\Gamification\Domain\MemberBadges\MemberBadges;
use Badger\Gamification\Domain\MemberBadges\MemberScore;

final class UserScoreComputation
{
    public function compute(MemberBadges $member, Badge $badge): MemberScore
    {
        return MemberScore::fromInt($member->getMemberScore()->get() + $badge->score()->get());
    }
}
