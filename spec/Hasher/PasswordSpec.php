<?php

namespace spec\Indigo\Guardian\Hasher;

use PhpSpec\ObjectBehavior;

class PasswordSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Indigo\Guardian\Hasher\Password');
    }

    function it_is_a_hasher()
    {
        $this->shouldImplement('Indigo\Guardian\Hasher');
    }

    function it_hashes_a_plaintext_password()
    {
        $this->hash('password')->shouldMatchPassword('password');
    }

    function it_verifies_that_a_plaintext_password_matches_a_hash()
    {
        $this->verify('password', password_hash('password', PASSWORD_DEFAULT))->shouldReturn(true);
    }

    function getMatchers()
    {
        return [
            'matchPassword' => function($subject, $password) {
                return password_verify($password, $subject);
            }
        ];
    }
}
