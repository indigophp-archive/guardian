<?php

/*
 * This file is part of the Indigo Guardian package.
 *
 * (c) Indigo Development Team
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Indigo\Guardian\Caller\User;

use Indigo\Guardian\Caller\User;
use Assert\Assertion;

/**
 * Simple user caller
 *
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class Simple implements User
{
    /**
     * @var string|integer
     */
    protected $id;

    /**
     * @var array
     */
    protected $data;

    /**
     * @param string|integer $id
     * @param array          $data
     */
    public function __construct($id, $data)
    {
        // TODO: check for id's type
        Assertion::choicesNotEmpty($data, ['username', 'password']);

        $this->id = $id;
        $this->data = $data;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getUsername()
    {
        return $this->data['username'];
    }

    /**
     * {@inheritdoc}
     */
    public function getPassword()
    {
        return $this->data['password'];
    }

    /**
     * Returns dynamic properties passed to the object
     *
     * Notice: property names should be camelCased
     *
     * @param string $method
     * @param array  $arguments
     *
     * @return mixed
     *
     * @throws BadMethodCallException If $method is not a property
     */
    public function __call($method, array $arguments)
    {
        if (substr($method, 0, 3) === 'get' and $property = substr($method, 3)) {
            $property = lcfirst($property);
            Assertion::notEmptyKey($this->data, $property, 'User does not have a(n) "%s" property');

            return $this->data[$property];
        }

        throw new \BadMethodCallException(sprintf('Method "%s" does not exists', $method));
    }
}
