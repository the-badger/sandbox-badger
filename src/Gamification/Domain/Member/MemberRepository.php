<?php

namespace Badger\Gamification\Domain\Member;

interface MemberRepository
{
    public function save(Member $member): void;

    public function nextIdentity(): MemberId;
}
