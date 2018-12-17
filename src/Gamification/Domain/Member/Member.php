<?php

declare(strict_types=1);

/*
 * This file is part of the Badger package
 *
 * (c) Olivier Soulet & Anael Chardan
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Badger\Gamification\Domain\Member;

final class Member
{
    /** @var MemberId */
    private $id;

    /** @var string */
    private $memberName;

    public function __construct(MemberId $id, string $memberName)
    {
        $this->id = $id;
        $this->memberName = $memberName;
    }

    public function id(): MemberId
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->memberName;
    }
}
