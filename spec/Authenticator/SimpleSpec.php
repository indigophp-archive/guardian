<?php

namespace spec\Indigo\Guardian\Authenticator;

use Indigo\Guardian\Verifier;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class SimpleSpec extends ObjectBehavior
{
    function let(Verifier $verifier)
    {
        $this->beConstructedWith([
            'username' => 'password'
        ], $verifier);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Indigo\Guardian\Authenticator\Simple');
    }

    function it_is_an_authenticator()
    {
        $this->shouldImplement('Indigo\Guardian\Authenticator');
    }

    function it_authenticates_a_subject(Verifier $verifier)
    {
        $verifier->verify('password', 'password')->willReturn(true);

        $this->authenticate([
            'username' => 'username',
            'password' => 'password',
        ])->shouldReturn(true);
    }

    function it_throws_an_exception_when_user_not_found()
    {
        $this->shouldThrow('Indigo\Guardian\Exception\UserNotFound')->duringAuthenticate([
            'username' => 'fake',
            'password' => 'password',
        ]);
    }
}
