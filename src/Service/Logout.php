<?php

/*
 * This file is part of the Indigo Guardian package.
 *
 * (c) Indigo Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Indigo\Guardian\Service;

use Indigo\Guardian\Session;

/**
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class Logout
{
    /**
     * @var Session
     */
    protected $session;

    /**
     * @param Session $session
     */
    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    /**
     * Logs a caller out
     */
    public function logout()
    {
        return $this->session->destroy();
    }
}
