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

namespace Badger\Gamification\Application;

use Badger\SharedSpace\Bus\Command;
use ConvenientImmutability\Immutable;

final class CreateABadge implements Command
{
    use Immutable;

    public $badgeId;
    public $title;
    public $description;

    public function identifierName(): string
    {
        return 'badgeId';
    }
}
