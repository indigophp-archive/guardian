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

use BeatSwitch\Lock\Callers\Caller;

/**
 * Main entry point
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class Guardian
{
    /**
     * @var Authenticator
     */
    protected $authenticator;

    /**
     * @var Identifier
     */
    protected $identifier;

    /**
     * @var Caller
     */
    protected $currentCaller;

    /**
     * @param Authenticator $authenticator
     * @param Identifier    $identifier
     */
    public function __construct(Authenticator $authenticator, Identifier $identifier)
    {
        $this->authenticator = $authenticator;
        $this->identifier = $identifier;
    }

    /**
     * Returns the Authenticator
     *
     * @return Authenticator
     */
    public function getAuthenticator()
    {
        return $this->authenticator;
    }

    /**
     * Returns the identifier
     *
     * @return Identifier
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * Identifies and authenticates a caller
     *
     * @param array $subject
     *
     * @return boolean
     */
    public function authenticate(array $subject)
    {
        $caller = $this->identifier->identify($subject);

        return $this->authenticator->authenticate($subject, $caller);
    }

    /**
     * Checks if there is a caller logged in
     *
     * @return boolean
     */
    public function isLoggedIn()
    {
        return isset($this->currentCaller);
    }

    /**
     * Logs a caller in
     *
     * TODO: Currently it only works pre request
     *
     * @param array $subject
     *
     * @return Caller
     */
    public function login(array $subject)
    {
        $caller = $this->identifier->identify($subject);

        if ($this->authenticator->authenticate($subject, $caller)) {
            return $this->currentCaller = $caller;
        }
    }

    /**
     * Returns the current caller
     *
     * @return Caller
     */
    public function getCurrentCaller()
    {
        return $this->currentCaller;
    }
}
