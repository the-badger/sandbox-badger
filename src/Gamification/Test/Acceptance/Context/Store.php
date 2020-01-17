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

final class Store
{
    private $store = [];

    const BADGER_MEMBER_NAME = 'badgerMemberName';

    public function set(string $key, $value): void
    {
        $this->store[$key] = $value;
    }

    public function get(string $key)
    {
        return $this->store[$key];
    }
}
