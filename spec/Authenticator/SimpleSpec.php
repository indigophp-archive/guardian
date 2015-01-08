<?php

namespace spec\Indigo\Guardian\Authenticator;

use Indigo\Guardian\Verifier;
use Indigo\Guardian\Caller\User;
use BeatSwitch\Lock\Callers\Caller;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SimpleSpec extends ObjectBehavior
{
    function let(Verifier $verifier)
    {
        $this->beConstructedWith($verifier);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Indigo\Guardian\Authenticator\Simple');
    }

    function it_is_an_authenticator()
    {
        $this->shouldImplement('Indigo\Guardian\Authenticator');
    }

    function it_authenticates_a_subject_against_a_caller(User $user, Verifier $verifier)
    {
        $user->getPassword()->willReturn('password');
        $verifier->verify('password', 'password')->willReturn(true);

        $this->authenticate(['password' => 'password'], $user)->shouldReturn(true);
    }

    function it_throws_an_exception_when_password_not_passed(User $user)
    {
        $this->shouldThrow('InvalidArgumentException')->duringAuthenticate([], $user);
    }

    function it_throws_an_exception_when_caller_is_not_a_user(Caller $caller)
    {
        $this->shouldThrow('InvalidArgumentException')->duringAuthenticate(['password' => 'password'], $caller);
    }
}
