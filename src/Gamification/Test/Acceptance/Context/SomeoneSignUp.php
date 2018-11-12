<?php

declare(strict_types=1);

namespace Badger\Gamification\Test\Acceptance\Context;

use Badger\Gamification\Application\SignUp;
use Behat\Behat\Context\Context;
use SimpleBus\SymfonyBridge\Bus\CommandBus;

final class SomeoneSignUp implements Context
{
    /** @var CommandBus */
    private $bus;

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
}
