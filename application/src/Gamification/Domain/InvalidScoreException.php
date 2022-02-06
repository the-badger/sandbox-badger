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

namespace Badger\Gamification\Domain;

class InvalidScoreException extends \InvalidArgumentException
{
    public function __construct()
    {
        parent::__construct('The score number is invalid');
    }
}
