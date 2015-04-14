<?php

namespace spec\Indigo\Guardian\Session;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class NativeSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Indigo\Guardian\Session\Native');
    }

    function it_is_a_session()
    {
        $this->shouldHaveType('Indigo\Guardian\Session');
    }

    function it_returns_a_login_token()
    {
        $this->setLoginToken('token');

        $this->getLoginToken()->shouldReturn('token');
    }

    function it_destroys_the_session()
    {
        $this->destroy()->shouldReturn(false);

        $this->setLoginToken('token');

        $this->destroy()->shouldReturn(true);

        $this->getLoginToken()->shouldReturn(null);
    }

    function letgo()
    {
        $this->destroy();
    }
}
