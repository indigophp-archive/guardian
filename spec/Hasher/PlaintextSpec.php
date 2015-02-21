<?php

namespace spec\Indigo\Guardian\Hasher;

use PhpSpec\ObjectBehavior;

class PlaintextSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Indigo\Guardian\Hasher\Plaintext');
    }

    function it_is_a_hasher()
    {
        $this->shouldImplement('Indigo\Guardian\Hasher');
    }

    function it_hashes_a_plaintext_password()
    {
        $this->hash('password')->shouldReturn('password');
    }

    function it_verifies_that_a_plaintext_password_matches_a_hash()
    {
        $this->verify('password', 'password')->shouldReturn(true);
    }
}
