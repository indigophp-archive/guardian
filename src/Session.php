<?php

/*
 * This file is part of the Indigo Guardian package.
 *
 * (c) Indigo Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Indigo\Guardian;

/**
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
interface Session
{
    /**
     * Returns a login token from the session
     *
     * @return integer|string
     */
    public function getLoginToken();

    /**
     * Stores a login token
     *
     * @param integer|string $loginToken
     */
    public function setLoginToken($loginToken);

    /**
     * Destroy the current session
     */
    public function destroy();
}
