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
use Indigo\Guardian\Exception\IdentificationFailed;
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
    }

    /**
     * Checks whether a user is logged in
     *
     * TODO: add further checks
     *
     * @return boolean
     */
    public function check()
    {
        $currentCaller = $this->getCurrentCaller();

        return isset($currentCaller);
    }

    /**
     * Returns the current caller
     *
     * @return HasLoginToken
     */
    public function getCurrentCaller()
    {
        if (is_null($this->currentCaller)) {
            $loginToken = $this->session->getLoginToken();

            try {
                $this->currentCaller = $this->identifier->identifyByLoginToken($loginToken);
            } catch (IdentificationFailed $e) {
                // we couldn't identify the caller, so we destroy the session
                // TODO: think about this
                $this->session->destroy();
            }
        }

        return $this->currentCaller;
    }
}
