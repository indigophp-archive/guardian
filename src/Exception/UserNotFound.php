<?php

/*
 * This file is part of the Indigo Guardian package.
 *
 * (c) Indigo Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Indigo\Guardian\Exception;

/**
 * Thrown when a user cannot be found
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class UserNotFound extends \Exception
{
    /**
     * @var string
     */
    protected $username;

    /**
     * @param string $username
     */
    public function __construct($username)
    {
        $this->username = $username;

        parent::__construct(sprintf('User "%s" cannot be found', $username));
    }

    /**
     * Returns the username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }
}
