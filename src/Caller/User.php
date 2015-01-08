<?php

/*
 * This file is part of the Indigo Guardian package.
 *
 * (c) Indigo Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Indigo\Guardian\Caller;

use BeatSwitch\Lock\Callers\Caller;

/**
 * User caller with some requirements
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
interface User extends Caller
{
    /**
     * Returns the hashed password
     *
     * @return string
     */
    public function getPassword();
}
