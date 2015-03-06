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
use Indigo\Guardian\Authenticator;
use Indigo\Guardian\Session;

/**
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class Login
{
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
     * @param Authenticator        $authenticator
     * @param Session              $session
     */
    public function __construct(
        LoginTokenIdentifier $identifier,
        Authenticator $authenticator,
        Session $session
    ) {
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

            return true;
        }

        return false;
    }
}
