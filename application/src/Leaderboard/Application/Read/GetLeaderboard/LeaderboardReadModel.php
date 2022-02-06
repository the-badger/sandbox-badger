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

namespace Badger\Leaderboard\Application\Read\GetLeaderboard;

use Badger\Gamification\Domain\Badge\Badge;
use Badger\Leaderboard\Domain\Leaderboard;
use Badger\SharedSpace\Bus\Query\ReadModel;

final class LeaderboardReadModel implements ReadModel
{
    public Leaderboard $leaderboard;

    public function __construct(Leaderboard $leaderboard)
    {
        $this->leaderboard = $leaderboard;
    }

    public function getValue(): array
    {
        return ["leaderboard" => $this->leaderboard->get()];
    }
}
