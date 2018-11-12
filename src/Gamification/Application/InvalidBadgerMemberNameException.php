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

final class InvalidBadgerMemberNameException extends \InvalidArgumentException
{
    public function __construct(int $currentLength)
    {
        $this->message = sprintf(
            'The Badger User Name should contain between 2 and 255 caracteres, currently %s',
            $currentLength
        );
    }
}
