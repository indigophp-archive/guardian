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

use Indigo\Guardian\Caller\HasLoginToken;
use Indigo\Guardian\Identifier\LoginTokenIdentifier;
use Indigo\Guardian\Session;

/**
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class Resume
{
    /**
     * @var HasLoginToken
     */
    protected $currentCaller;

    /**
     * @var LoginTokenIdentifier
     */
    protected $identifier;

    /**
     * @var Session
     */
    protected $session;

    /**
     * @param LoginTokenIdentifier $identifier
     * @param Session              $session
     */
    public function __construct(LoginTokenIdentifier $identifier, Session $session)
    {
        $this->identifier = $identifier;
        $this->session = $session;

        $loginToken = $session->getLoginToken();
        $this->currentCaller = $identifier->identifyByLoginToken($loginToken);
    }

    /**
     * Checks whether a user is logged in
     *
     * @return boolean
     */
    public function check()
    {
        return isset($this->currentCaller);
    }

    /**
     * Returns the current caller
     *
     * @return HasLoginToken
     */
    public function getCurrentCaller()
    {
        return $this->currentCaller;
    }
}
