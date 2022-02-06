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

namespace Badger\Member\Application\Event\CrossDomain;

use Badger\SharedSpace\Bus\Event\CrossDomainEvent;
use Badger\SharedSpace\Bus\Event\EventHandler;

final class ExecuteDomainActionHandler implements EventHandler
{
    private array $domainActions = [
        ""
    ];

    public function __invoke(CrossDomainEvent $crossDomainEvent)
    {
        var_dump('toto');
    }
}
