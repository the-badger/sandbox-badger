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

namespace Badger\Gamification\Application\Event;

use Badger\SharedSpace\Bus\Event\EventHandler;

final class SendNotificationWhenBadgeCreatedHandler implements EventHandler
{
    public function __invoke(BadgeCreated $badgeAccepted)
    {
        var_dump('toto');die;
    }
}
