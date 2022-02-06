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

namespace Badger\Gamification\Domain\MemberBadges\MaybeMember;

use Badger\Gamification\Domain\MemberBadges\MemberBadges;
use Phunkie\Types\Option;
use Phunkie\Types\Some;

final class MemberOption
{
    private Option $option;

    private function __construct(Option $option)
    {
        $this->option = $option;
    }

    public static function none(): MemberOption
    {
        return MemberOption::fromValue(null);
    }

    public static function some(MemberBadges $member): MemberOption
    {
        return MemberOption::fromValue($member);
    }

    public static function fromValue(?MemberBadges $value): MemberOption
    {
        return new MemberOption(\Option($value));
    }

    public function isEmpty(): bool
    {
        return $this->option->isEmpty();
    }

    public function member(): MemberBadges
    {
        if ($this->option instanceof Some) {
            return $this->option->get();
        }

        throw new \RuntimeException('Nothing to get');
    }
}
