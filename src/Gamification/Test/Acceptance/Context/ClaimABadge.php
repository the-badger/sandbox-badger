<?php

declare(strict_types=1);

namespace Badger\Gamification\Test\Acceptance\Context;

use Badger\Gamification\Application\SignUp;
use Behat\Behat\Context\Context;
use Behat\Behat\Tester\Exception\PendingException;
use SimpleBus\SymfonyBridge\Bus\CommandBus;

final class ClaimABadge implements Context
{
    /** @var CommandBus */
    private $bus;

    private $memberId;

    public function __construct(CommandBus $bus)
    {
        $this->bus = $bus;
    }

    /**
     * @Given a badger member :badgerMember
     */
    public function aBadgeMember(string $badgeMember): void
    {
        $signUpCommand = new SignUp($badgeMember);
        $this->bus->handle($signUpCommand);
    }

    /**
     * @Then I should be able to claim the badge :arg1
     */
    public function iShouldBeAbleToClaimTheBadge($arg1)
    {
//        $claimABadge = new Badger\Gamification\Application\Command\ClaimABadge($use);
    }
}
