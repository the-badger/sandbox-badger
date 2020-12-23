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

namespace Badger\Gamification\Application\Read\GetABadge;

use Badger\SharedSpace\Bus\Query\Query;
use ConvenientImmutability\Immutable;

final class GetABadge implements Query
{
    use Immutable;

    public ?string $badgeId = null;
}
