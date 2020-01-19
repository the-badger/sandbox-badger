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

namespace Badger\Gamification\Test\Acceptance\Context;

use Badger\Gamification\Domain\Member\MemberName;

final class Store
{
    private MemberName $memberName;

    public function setBadgerMemberName(MemberName $memberName): void
    {
        $this->memberName = $memberName;
    }

    public function getMemberName(): MemberName
    {
        return $this->memberName;
    }
}
