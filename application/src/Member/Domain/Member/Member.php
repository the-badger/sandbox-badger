<?php

/*
 * This file is part of the Badger package
 *
 * (c) Olivier Soulet & Anael Chardan
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Badger\Member\Domain\Member;

use Phunkie\Types\ImmSet;

class Member
{
    public MemberId $id;
    public MemberName $memberName;
    public ImmSet $claimedBadges;
    public ImmSet $earnedBadges;
    public MemberScore $memberScore;

    public function __construct(MemberId $id, MemberName $memberName)
    {
        $this->id = $id;
        $this->memberName = $memberName;
    }

    public function id(): MemberId
    {
        return $this->id;
    }

    public function name(): MemberName
    {
        return $this->memberName;
    }
}
