<?php

namespace spec\Indigo\Guardian\Verifier;

use PhpSpec\ObjectBehavior;

class PlaintextSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Indigo\Guardian\Verifier\Plaintext');
    }

    function it_is_a_verifier()
    {
        $this->shouldImplement('Indigo\Guardian\Verifier');
    }

    function it_verifies_that_a_plaintext_password_mathces_a_hash()
    {
        $this->verify('password', 'password')->shouldReturn(true);
    }
}
