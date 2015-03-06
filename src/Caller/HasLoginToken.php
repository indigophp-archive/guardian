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
 * Declares a Caller which can be logged in a session by using custom Login Token
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
interface HasLoginToken extends Caller
{
    /**
     * Returns a scalar type token
     *
     * @return integer|string
     */
    public function getLoginToken();
}
