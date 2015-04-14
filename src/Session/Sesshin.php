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
use Sesshin\Session as SesshinSession;

/**
 * @author Márk Sági-Kazár <mark.sagikazar@gmail.com>
 */
class Sesshin implements Session
{
    /**
     * @var SesshinSession
     */
    protected $sesshin;

    /**
     * @param SesshinSession $sesshin
     */
    public function __construct(SesshinSession $sesshin)
    {
        $this->sesshin = $sesshin;

        if (!$sesshin->isOpened()) {
            $sesshin->open(true);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getLoginToken()
    {
        return $this->sesshin->getValue('loginToken', 'guardian');
    }

    /**
     * {@inheritdoc}
     */
    public function setLoginToken($loginToken)
    {
        $this->sesshin->setValue('loginToken', $loginToken, 'guardian');
    }

    /**
     * {@inheritdoc}
     */
    public function destroy()
    {
        $this->sesshin->unsetValue('loginToken', 'guardian');

        return true;
    }
}
