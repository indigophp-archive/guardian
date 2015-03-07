<?php

/*
 * This file is part of the Indigo Guardian package.
 *
 * (c) Indigo Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Indigo\Guardian\Session;

use Indigo\Guardian\Session;

/**
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class Native implements Session
{
    /**
     * @var string
     */
    protected $sessionKey;

    /**
     * @param string $sessionKey
     */
    public function __construct($sessionKey = 'guardian')
    {
        $this->sessionKey = $sessionKey;

        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getLoginToken()
    {
        if (isset($_SESSION[$this->sessionKey]['loginToken'])) {
            return $_SESSION[$this->sessionKey]['loginToken'];
        }
    }

    /**
     * {@inheritdoc}
     */
    public function setLoginToken($loginToken)
    {
        $_SESSION[$this->sessionKey]['loginToken'] = $loginToken;
    }

    /**
     * {@inheritdoc}
     */
    public function destroy()
    {
        if (isset($_SESSION[$this->sessionKey]['loginToken'])) {
            unset($_SESSION[$this->sessionKey]['loginToken']);

            return true;
        }

        return false;
    }
}
