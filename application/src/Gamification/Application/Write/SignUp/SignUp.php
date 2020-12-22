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

namespace Badger\Gamification\Application\Write\SignUp;

use Badger\SharedSpace\Bus\Command\Command;
use ConvenientImmutability\Immutable;

final class SignUp implements Command
{
    use Immutable;

    public ?string $badgerUserName = null;
}
