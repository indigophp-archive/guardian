<?php

namespace spec\Indigo\Guardian\Session;

use Sesshin\Session;
use PhpSpec\ObjectBehavior;

class SesshinSpec extends ObjectBehavior
{
    function let(Session $sesshin)
    {
        $sesshin->isOpened()->willReturn(true);

        $this->beConstructedWith($sesshin);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Indigo\Guardian\Session\Sesshin');
    }

    function it_is_a_session()
    {
        $this->shouldHaveType('Indigo\Guardian\Session');
    }

    function it_returns_a_login_token(Session $sesshin)
    {
        $sesshin->getValue('loginToken', 'guardian')->willReturn('token');

        $this->getLoginToken()->shouldReturn('token');
    }

    function it_accepts_a_login_token(Session $sesshin)
    {
        $sesshin->setValue('loginToken', 'token', 'guardian')->shouldBeCalled();

        $this->setLoginToken('token');
    }

    function it_destroys_a_session(Session $sesshin)
    {
        $sesshin->unsetValue('loginToken', 'guardian')->shouldBeCalled();

        $this->destroy()->shouldReturn(true);
    }
}
