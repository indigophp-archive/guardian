<?php

namespace spec\Indigo\Guardian;

use Indigo\Guardian\Authenticator;
use Indigo\Guardian\Caller\HasLoginToken;
use Indigo\Guardian\Identifier\LoginTokenIdentifier;
use Indigo\Guardian\Session;
use PhpSpec\ObjectBehavior;

class SessionAuthSpec extends ObjectBehavior
{
    function let(LoginTokenIdentifier $identifier, Authenticator $authenticator, Session $session)
    {
        $this->beConstructedWith($identifier, $authenticator, $session);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Indigo\Guardian\SessionAuth');
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
        $this->getCurrentCaller()->shouldReturn($caller);
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

    function it_checks_out(Session $session, LoginTokenIdentifier $identifier, HasLoginToken $caller)
    {
        $session->getLoginToken()->willReturn(1);
        $identifier->identifyByLoginToken(1)->willReturn($caller);

        $this->check()->shouldReturn(true);
    }

    function it_does_not_check_out_if_caller_not_found(Session $session, LoginTokenIdentifier $identifier, HasLoginToken $caller)
    {
        $session->getLoginToken()->willReturn(1);
        $session->destroy()->shouldBeCalled();
        $identifier->identifyByLoginToken(1)->willThrow('Indigo\Guardian\Exception\IdentificationFailed');

        $this->check()->shouldReturn(false);
    }

    function it_has_a_caller(Session $session, LoginTokenIdentifier $identifier, HasLoginToken $caller)
    {
        $session->getLoginToken()->willReturn(1);
        $identifier->identifyByLoginToken(1)->willReturn($caller);

        $this->getCurrentCaller()->shouldReturn($caller);
    }

    function it_logs_a_caller_out(Session $session)
    {
        $session->destroy()->willReturn(true);

        $this->logout()->shouldReturn(true);
    }
}
