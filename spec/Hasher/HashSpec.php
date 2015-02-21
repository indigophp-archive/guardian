<?php

namespace spec\Indigo\Guardian\Hasher;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class HashSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('md5');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Indigo\Guardian\Hasher\Hash');
    }

    function it_is_a_hasher()
    {
        $this->shouldImplement('Indigo\Guardian\Hasher');
    }

    function it_hashes_a_plaintext_password()
    {
        $this->hash('password')->shouldReturn(hash('md5', 'password'));
    }

    function it_verifies_that_a_plaintext_password_matches_a_hash()
    {
        $this->verify('password', hash('md5', 'password'))->shouldReturn(true);
    }
}
