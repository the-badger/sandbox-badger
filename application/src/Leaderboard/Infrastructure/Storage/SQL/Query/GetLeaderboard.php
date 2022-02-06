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

namespace Badger\Leaderboard\Infrastructure\Storage\SQL\Query;

use Badger\Leaderboard\Domain\Leaderboard;
use Badger\Member\Domain\Member\Member;
use Doctrine\DBAL\Connection;
use Badger\Leaderboard\Domain\GetLeaderboard as GetLeaderboardInterface;

final class GetLeaderboard implements GetLeaderboardInterface
{
    private Connection $connection;

    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    public function __invoke(): Leaderboard
    {
        $query = <<<SQL
SELECT id AS "member_id", member_score AS "member_score" FROM member_badges ORDER BY member_score DESC;
SQL;

        $result = $this->connection->executeQuery($query)->fetchAll();

        $memberLeaderboard = [];

        foreach ($result as $member) {
            if (!array_key_exists($member["member_score"], $memberLeaderboard)) {
                $memberLeaderboard[$member["member_score"]] = [];
            }
            $memberLeaderboard[$member["member_score"]][] = $member["member_id"];
        }

        return new Leaderboard($memberLeaderboard);
    }
}
