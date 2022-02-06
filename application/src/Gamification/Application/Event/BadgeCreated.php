<?php

/*
 * This file is part of the Badger package
 *
 * (c) Olivier Soulet & Anael Chardan
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Badger\Gamification\Application\Event;

use Badger\SharedSpace\Bus\Event\Event;
use ConvenientImmutability\Immutable;

final class BadgeCreated implements Event
{
    use Immutable;

    public ?string $badgeId = null;
}
