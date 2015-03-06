<?php

namespace spec\Indigo\Guardian\Service;

use Indigo\Guardian\Session;
use PhpSpec\ObjectBehavior;

class LogoutSpec extends ObjectBehavior
{
    function let(Session $session)
    {
        $this->beConstructedWith($session);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Indigo\Guardian\Service\Logout');
    }

    function it_logs_a_caller_out(Session $session)
    {
        $session->destroy()->willReturn(true);

        $this->logout()->shouldReturn(true);
    }
}
