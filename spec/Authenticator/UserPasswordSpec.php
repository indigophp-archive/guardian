<?php

namespace spec\Indigo\Guardian\Authenticator;

use Indigo\Guardian\Hasher;
use Indigo\Guardian\Caller\User;
use Indigo\Guardian\Caller;
use PhpSpec\ObjectBehavior;

class UserPasswordSpec extends ObjectBehavior
{
    function let(Hasher $hasher)
    {
        $this->beConstructedWith($hasher);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Indigo\Guardian\Authenticator\UserPassword');
    }

    function it_is_an_authenticator()
    {
        $this->shouldImplement('Indigo\Guardian\Authenticator');
    }

    function it_authenticates_a_subject_against_a_caller(User $user, Hasher $hasher)
    {
        $user->getPassword()->willReturn('hashed_password');
        $hasher->verify('plain_password', 'hashed_password')->willReturn(true);

        $this->authenticate(['password' => 'plain_password'], $user)->shouldReturn(true);
    }

    function it_throws_an_exception_when_password_is_not_passed(User $user)
    {
        $this->shouldThrow('InvalidArgumentException')->duringAuthenticate([], $user);
    }

    function it_throws_an_exception_when_caller_is_not_a_user(Caller $caller)
    {
        $this->shouldThrow('InvalidArgumentException')->duringAuthenticate(['password' => 'plain_password'], $caller);
    }
}
