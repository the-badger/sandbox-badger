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

namespace Badger\Gamification\Application\Write\RefuseABadge;

use Badger\SharedSpace\Bus\Command\Command;
use ConvenientImmutability\Immutable;

final class RefuseABadge implements Command
{
    use Immutable;

    public ?string $memberId = null;
    public ?string $badgeId = null;
}
