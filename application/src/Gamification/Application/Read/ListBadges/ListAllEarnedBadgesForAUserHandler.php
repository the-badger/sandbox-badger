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

use Badger\Gamification\Domain\Member\MemberId;
use Badger\Gamification\Domain\Member\MemberRepository;
use Badger\Gamification\Domain\Member\UnexistingMemberException;
use Badger\SharedSpace\Bus\Query\QueryHandler;
use Badger\SharedSpace\Bus\Query\ReadModel;

final class ListAllEarnedBadgesForAUserHandler implements QueryHandler
{
    private MemberRepository $memberRepository;

    public function __construct(MemberRepository $memberRepository)
    {
        $this->memberRepository = $memberRepository;
    }

    public function __invoke(ListAllEarnedBadgesForAUser $listAllEarnedBadgesForAUser): ReadModel
    {
        $memberOption = $this->memberRepository->get(MemberId::fromUuidString($listAllEarnedBadgesForAUser->memberId));

        if ($memberOption->isEmpty()) {
            throw new UnexistingMemberException(MemberId::fromUuidString($listAllEarnedBadgesForAUser->memberId));
        }

        $earnedBadges = $memberOption->member()->getEarnedBadges();

        return new MemberClaimedBadgesReadModel($earnedBadges);
    }
}
