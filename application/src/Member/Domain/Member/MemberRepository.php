<?php

namespace Badger\Member\Domain\Member;

use Badger\Member\Domain\Member\MaybeMember\MemberOption;

interface MemberRepository
{
    public function save(Member $member): void;

    public function get(MemberId $memberId): MemberOption;

    public function findByName(MemberName $memberName): MemberOption;
}
