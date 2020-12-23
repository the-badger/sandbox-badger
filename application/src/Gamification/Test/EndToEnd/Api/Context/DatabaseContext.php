<?php

declare(strict_types=1);

namespace Badger\Gamification\Test\EndToEnd\Api\Context;

use Badger\SharedSpace\Tool\Behat\DatabasePurger;
use Behat\Behat\Context\Context;

class DatabaseContext implements Context
{
    private DatabasePurger $databasePurger;

    public function __construct(DatabasePurger $databasePurger)
    {
        $this->databasePurger = $databasePurger;
    }

    /**
     * @BeforeScenario
     */
    public function before(): void
    {
        $this->databasePurger->beginTransaction();
    }

    /**
     * @AfterScenario
     */
    public function after(): void
    {
        $this->databasePurger->rollback();
    }
}
