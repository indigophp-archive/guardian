<?php

namespace spec\Indigo\Guardian;

use Indigo\Guardian\Authenticator;
use Indigo\Guardian\Caller;
use Indigo\Guardian\Identifier;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RequestAuthSpec extends ObjectBehavior
{
    function let(Identifier $identifier, Authenticator $authenticator)
    {
        $this->beConstructedWith($identifier, $authenticator);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Indigo\Guardian\RequestAuth');
    }

    function it_authenticates_a_request(Identifier $identifier, Caller $caller, Authenticator $authenticator)
    {
        $subject = [
            'username' => 'john.doe',
            'password' => 'secret',
        ];

        $identifier->identify($subject)->willReturn($caller);
        $authenticator->authenticate($subject, $caller)->willReturn(true);

        $this->authenticate($subject)->shouldReturn(true);
    }

    function it_fails_to_authenticates_a_request(Identifier $identifier, Caller $caller, Authenticator $authenticator)
    {
        $subject = [
            'username' => 'john.doe',
            'password' => 'secret',
        ];

        $identifier->identify($subject)->willReturn($caller);
        $authenticator->authenticate($subject, $caller)->willReturn(false);

        $this->authenticate($subject)->shouldReturn(false);
    }

    function it_authenticates_a_request_and_returns_the_caller(Identifier $identifier, Caller $caller, Authenticator $authenticator)
    {
        $subject = [
            'username' => 'john.doe',
            'password' => 'secret',
        ];

        $identifier->identify($subject)->willReturn($caller);
        $authenticator->authenticate($subject, $caller)->willReturn(true);

        $this->authenticateAndReturn($subject)->shouldReturn($caller);
    }

    function it_returns_null_if_authentication_fails(Identifier $identifier, Caller $caller, Authenticator $authenticator)
    {
        $subject = [
            'username' => 'john.doe',
            'password' => 'secret',
        ];

        $identifier->identify($subject)->willReturn($caller);
        $authenticator->authenticate($subject, $caller)->willReturn(false);

        $this->authenticateAndReturn($subject)->shouldReturn(null);
    }
}
