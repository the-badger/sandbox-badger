<?php

declare(strict_types=1);

namespace Badger\Gamification\Test\Acceptance\Context;

use Badger\Gamification\Application\SignUp;
use Badger\Gamification\Domain\Member\MemberRepository;
use Behat\Behat\Context\Context;
use SimpleBus\SymfonyBridge\Bus\CommandBus;

final class ClaimABadge implements Context
{
    /** @var CommandBus */
    private $bus;

    /** @var string */
    private $memberUserName;

    /** @var MemberRepository */
    private $memberRepository;

    public function __construct(CommandBus $bus, MemberRepository $memberRepository)
    {
        $this->bus = $bus;
        $this->memberRepository = $memberRepository;
    }

    /**
     * @Given a badger member :badgerMember
     */
    public function aBadgeMember(string $badgeMember): void
    {
        $signUpCommand = new SignUp($badgeMember);
        $this->bus->handle($signUpCommand);
        $this->memberUserName = $badgeMember;
    }

    /**
     * @Given a badge named :arg1
     */
    public function aBadgeNamed($arg1)
    {
        $memberOption = $this->memberRepository->findByName($this->memberUserName);

        return false;
//        $claimABadge = new Badger\Gamification\Application\Command\ClaimABadge($use);
    }

    /**
     * @Then I should be able to claim the badge :arg1
     */
    public function iShouldBeAbleToClaimTheBadge($arg1)
    {
        $memberOption = $this->memberRepository->findByName($this->memberUserName);

        return false;
//        $claimABadge = new Badger\Gamification\Application\Command\ClaimABadge($use);
    }
}
