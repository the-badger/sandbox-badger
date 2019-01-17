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

use Badger\Gamification\Domain\Badge\BadgeRepository;
use Badger\Gamification\Domain\Member\MemberRepository;
use Badger\SharedSpace\Bus\CommandHandler;

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
        // TODO: write logic here
    }
}
