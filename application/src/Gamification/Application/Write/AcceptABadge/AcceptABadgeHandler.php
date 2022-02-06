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

namespace Badger\Gamification\Application\Write\AcceptABadge;

use Badger\Gamification\Application\Event\BadgeAccepted;
use Badger\Gamification\Domain\Badge\BadgeDoesNotExistException;
use Badger\Gamification\Domain\Badge\BadgeId;
use Badger\Gamification\Domain\Badge\BadgeRepository;
use Badger\Gamification\Domain\MemberBadges\MemberId;
use Badger\Gamification\Domain\MemberBadges\MemberBadgesRepository;
use Badger\Gamification\Domain\MemberBadges\NoMemberBadgesException;
use Badger\SharedSpace\Bus\Command\CommandHandler;
use Badger\SharedSpace\Bus\Event\EventBus;

final class AcceptABadgeHandler implements CommandHandler
{
    private MemberBadgesRepository $memberBadgesRepository;
    private BadgeRepository $badgeRepository;
    private EventBus $eventBus;

    public function __construct(MemberBadgesRepository $memberBadgesRepository, BadgeRepository $badgeRepository, EventBus $eventBus)
    {
        $this->memberBadgesRepository = $memberBadgesRepository;
        $this->badgeRepository = $badgeRepository;
        $this->eventBus = $eventBus;
    }

    public function __invoke(AcceptABadge $acceptABadge): void
    {
        $memberId = MemberId::fromUuidString($acceptABadge->memberId);
        $memberBadgesOption = $this->memberBadgesRepository->get($memberId);

        if ($memberBadgesOption->isEmpty()) {
            throw new NoMemberBadgesException($memberId);
        }
        $badgeId = BadgeId::fromUuidString($acceptABadge->badgeId);
        $badgeOption = $this->badgeRepository->get($badgeId);

        if ($badgeOption->isEmpty()) {
            throw new BadgeDoesNotExistException($badgeId);
        }

        $memberBadges = $memberBadgesOption->member();
        if ($memberBadges->claimedBadges->contains($badgeId)) {
            $memberBadges->claimedBadges = $memberBadges->claimedBadges->minus($badgeId);
        }

        $memberBadges->earnABadge($badgeId);

        $this->memberBadgesRepository->save($memberBadges);

        $badgeAccepted = new BadgeAccepted();
        $badgeAccepted->memberId = $acceptABadge->memberId;
        $badgeAccepted->badgeId = $acceptABadge->badgeId;

        $this->eventBus->dispatchAfter($badgeAccepted);
    }
}
