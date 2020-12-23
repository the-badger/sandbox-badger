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

namespace Badger\Gamification\Application\Read\ListBadges;

use Badger\Gamification\Infrastructure\Storage\Doctrine\Repository\Member\MemberRepository;
use Badger\SharedSpace\Bus\Query\QueryHandler;
use Badger\SharedSpace\Bus\Query\ReadModel;

final class ListAllClaimedBadgesForAUserHandler implements QueryHandler
{
    private MemberRepository $memberRepository;

    public function __construct(MemberRepository $memberRepository)
    {
        $this->memberRepository = $memberRepository;
    }

    public function __invoke(ListAllClaimedBadgesForAUser $listAllClaimedBadgesForAUser): ReadModel
    {
        return new BadgesReadModel($this->memberRepository->all());
    }
}
