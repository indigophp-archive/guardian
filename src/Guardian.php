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
     * Identifies a subject
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
}
