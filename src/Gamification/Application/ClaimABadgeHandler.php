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

namespace Badger\Gamification\Application;

use Badger\Gamification\Domain\Badge\BadgeId;
use Badger\Gamification\Domain\Badge\BadgeRepository;
use Badger\Gamification\Domain\Badge\UnexistingBadgeException;
use Badger\Gamification\Domain\Member\Member;
use Badger\Gamification\Domain\Member\MemberId;
use Badger\Gamification\Domain\Member\MemberRepository;
use Badger\Gamification\Domain\Member\UnexistingMemberException;
use Badger\SharedSpace\Bus\CommandHandler;
use spec\Phunkie\Cats\User;

final class ClaimABadgeHandler implements CommandHandler
{
    /** @var MemberRepository */
    private $memberRepository;

    /** @var BadgeRepository */
    private $badgeRepository;

    public function __construct(MemberRepository $memberRepository, BadgeRepository $badgeRepository)
    {
        $this->memberRepository = $memberRepository;
        $this->badgeRepository = $badgeRepository;
    }

    public function __invoke(ClaimABadge $claimABadge)
    {
        $memberId = new MemberId($claimABadge->memberId);
        $member = $this->memberRepository->get(new MemberId($claimABadge->memberId));

        if ($member->option()->isEmpty()) {
            throw new UnexistingMemberException($memberId);
        }

        $badgeId = new BadgeId($claimABadge->badgeId);
        $badge = $this->badgeRepository->get($badgeId);

        if ($badge->option()->isEmpty()) {
            throw new UnexistingBadgeException($badgeId);
        }

        /** @var Member $member */
        $member = $member->option()->get();

        $this->memberRepository->save($member->claimABadge($badgeId));
    }
}
