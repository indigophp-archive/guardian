<?php

namespace spec\Indigo\Guardian\Service;

use Indigo\Guardian\Authenticator;
use Indigo\Guardian\Caller\HasLoginToken;
use Indigo\Guardian\Identifier\LoginTokenIdentifier;
use Indigo\Guardian\Session;
use PhpSpec\ObjectBehavior;

class LoginSpec extends ObjectBehavior
{
    function let(LoginTokenIdentifier $identifier, Authenticator $authenticator, Session $session)
    {
        $this->beConstructedWith($identifier, $authenticator, $session);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Indigo\Guardian\Service\Login');
    }

    function it_logs_a_caller_in(LoginTokenIdentifier $identifier, HasLoginToken $caller, Authenticator $authenticator, Session $session)
    {
        $subject = [
            'username' => 'john.doe',
            'password' => 'secret',
        ];

        $caller->getLoginToken()->willReturn(1);
        $identifier->identify($subject)->willReturn($caller);
        $authenticator->authenticate($subject, $caller)->willReturn(true);
        $session->setLoginToken(1)->shouldBeCalled();

        $this->login($subject)->shouldReturn(true);
    }

    function it_fails_to_log_a_caller_in(LoginTokenIdentifier $identifier, HasLoginToken $caller, Authenticator $authenticator, Session $session)
    {
        $subject = [
            'username' => 'john.doe',
            'password' => 'secret',
        ];

        $caller->getLoginToken()->willReturn(1);
        $identifier->identify($subject)->willReturn($caller);
        $authenticator->authenticate($subject, $caller)->willReturn(false);
        $session->setLoginToken(1)->shouldNotBeCalled();

        $this->login($subject)->shouldReturn(false);
    }
}

