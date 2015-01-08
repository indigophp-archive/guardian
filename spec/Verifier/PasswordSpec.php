<?php

namespace spec\Indigo\Guardian\Verifier;

use PhpSpec\ObjectBehavior;

class PasswordSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Indigo\Guardian\Verifier\Password');
    }

    function it_is_a_verifier()
    {
        $this->shouldImplement('Indigo\Guardian\Verifier');
    }

    function it_verifies_that_a_plaintext_password_mathces_a_hash()
    {
        $this->verify('password', password_hash('password', PASSWORD_DEFAULT))->shouldReturn(true);
    }

    function it_verifies_that_a_plaintext_password_mathces_a_custom_hash()
    {
        $this->beConstructedWith('md5');

        $this->verify('password', hash('md5', 'password'))->shouldReturn(true);
    }
}