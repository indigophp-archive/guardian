<?php

namespace spec\Indigo\Guardian\Service;

use Indigo\Guardian\Caller\HasLoginToken;
use Indigo\Guardian\Identifier\LoginTokenIdentifier;
use Indigo\Guardian\Session;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ResumeSpec extends ObjectBehavior
{
    function let(Session $session, LoginTokenIdentifier $identifier, HasLoginToken $caller)
    {
        $session->getLoginToken()->willReturn(1);
        $identifier->identifyByLoginToken(1)->willReturn($caller);

        $this->beConstructedWith($identifier, $session);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Indigo\Guardian\Service\Resume');
    }

    function it_checks_out()
    {
        $this->check()->shouldReturn(true);
    }

    function it_has_a_caller(HasLoginToken $caller)
    {
        $this->getCurrentCaller()->shouldReturn($caller);
    }
}
