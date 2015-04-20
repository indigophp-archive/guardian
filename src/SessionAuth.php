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

use Indigo\Guardian\Caller\HasLoginToken;
use Indigo\Guardian\Exception\IdentificationFailed;
use Indigo\Guardian\Identifier\LoginTokenIdentifier;

/**
 * This authentication type is responsible for storing a token in the session
 * and maintaining user login/logout/check
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class SessionAuth
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
     * @var Authenticator
     */
    protected $authenticator;

    /**
     * @var Session
     */
    protected $session;

    /**
     * @param LoginTokenIdentifier $identifier
     * @param Authenticatior       $authenticator
     * @param Session              $session
     */
    public function __construct(LoginTokenIdentifier $identifier, Authenticator $authenticator, Session $session)
    {
        $this->identifier = $identifier;
        $this->authenticator = $authenticator;
        $this->session = $session;
    }

    /**
     * Logs a subject in
     *
     * @param array $subject
     */
    public function login(array $subject)
    {
        /** @var HasLoginToken */
        $caller = $this->identifier->identify($subject);

        if ($this->authenticator->authenticate($subject, $caller)) {
            $this->session->setLoginToken($caller->getLoginToken());
            $this->currentCaller = $caller;

            return true;
        }

        return false;
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

    /**
     * Logs a caller out
     */
    public function logout()
    {
        return $this->session->destroy();
    }
}
