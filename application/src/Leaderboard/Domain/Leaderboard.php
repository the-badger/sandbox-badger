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

namespace Badger\Leaderboard\Domain;

final class Leaderboard
{
    private array $leaderboard;

    public function __construct(array $memberLeaderboard)
    {
        $this->leaderboard = $memberLeaderboard;
    }

    public function get(): array
    {
        return $this->leaderboard;
    }
}
