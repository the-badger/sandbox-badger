<?php

declare(strict_types=1);

namespace Badger\Gamification\Test\EndToEnd\Api\Context;

use Behat\Behat\Context\Context;

final class AuthenticationContext implements Context
{
    /**
     * @Given a badger :role :badgerMember
     */
    public function aBadgeMember(string $role, string $badgeMember): bool
    {
        return true;
    }
}
