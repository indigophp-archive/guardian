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

use Indigo\Guardian\Caller;

/**
 * User caller with some requirements
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
interface User extends Caller
{
    /**
     * Returns the username
     *
     * @return string
     */
    public function getUsername();

    /**
     * Returns the hashed password
     *
     * @return string
     */
    public function getPassword();
}
