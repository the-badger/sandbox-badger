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

namespace Badger\Leaderboard\Application\Read\GetLeaderboard;

use Badger\SharedSpace\Bus\Query\QueryHandler;
use Badger\SharedSpace\Bus\Query\ReadModel;
use \Badger\Leaderboard\Domain\GetLeaderboard as GetLeaderBoardRepository;

final class GetLeaderboardHandler implements QueryHandler
{
    private GetLeaderBoardRepository $leaderboardBuilder;

    public function __construct(GetLeaderBoardRepository $leaderboardBuilder)
    {
        $this->leaderboardBuilder = $leaderboardBuilder;
    }

    public function __invoke(GetLeaderboard $getLeaderboard): ReadModel
    {
        $leaderboard = $this->leaderboardBuilder->__invoke();

        return new LeaderboardReadModel($leaderboard);
    }
}
