<?php

namespace spec\Indigo\Guardian;

use Indigo\Guardian\Authenticator;
use Indigo\Guardian\Identifier;
use BeatSwitch\Lock\Callers\Caller;
use PhpSpec\ObjectBehavior;

class GuardianSpec extends ObjectBehavior
{
    function let(Authenticator $authenticator, Identifier $identifier)
    {
        $this->beConstructedWith($authenticator, $identifier);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Indigo\Guardian\Guardian');
    }

    function it_has_an_authenticator()
    {
        $this->getAuthenticator()->shouldHaveType('Indigo\Guardian\Authenticator');
    }

    function it_has_an_identifier()
    {
        $this->getIdentifier()->shouldHaveType('Indigo\Guardian\Identifier');
    }

    function it_identifies_and_authenticates_a_caller(Authenticator $authenticator, Identifier $identifier, Caller $caller)
    {
        $subject = [
            'username' => 'john_doe',
            'password' => 'hashed_password',
        ];

        $identifier->identify($subject)->willReturn($caller);
        $authenticator->authenticate($subject, $caller)->willReturn(true);

        $this->authenticate($subject)->shouldReturn(true);
    }

    function it_logs_a_caller_in(Authenticator $authenticator, Identifier $identifier, Caller $caller)
    {
        $subject = [
            'username' => 'john_doe',
            'password' => 'hashed_password',
        ];

        $identifier->identify($subject)->willReturn($caller);
        $authenticator->authenticate($subject, $caller)->willReturn(true);

        $this->isLoggedIn()->shouldReturn(false);

        $this->login($subject)->shouldReturn($caller);

        $this->isLoggedIn()->shouldReturn(true);
        $this->getCurrentCaller()->shouldReturn($caller);
    }
}
