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

namespace Badger\Gamification\Application\Write\ClaimABadge;

use Badger\SharedSpace\Bus\Command\Command;
use ConvenientImmutability\Immutable;

final class ClaimABadge implements Command
{
    use Immutable;

    public ?string $identifier = null;
    public ?string $memberId = null;
    public ?string $badgeId = null;

    public function identifierName(): string
    {
        return 'identifier';
    }
}
