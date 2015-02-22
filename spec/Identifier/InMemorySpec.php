<?php

namespace spec\Indigo\Guardian\Identifier;

use PhpSpec\ObjectBehavior;

class InMemorySpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith([
            [
                'username' => 'john_doe',
                'password' => 'hashed_password',
                'name'     => 'John Doe',
            ],
        ]);
    }
    function it_is_initializable()
    {
        $this->shouldHaveType('Indigo\Guardian\Identifier\InMemory');
    }

    function it_is_an_identifier()
    {
        $this->shouldImplement('Indigo\Guardian\Identifier');
    }

    function it_identifies_a_caller()
    {
        $caller = $this->identify(['username' => 'john_doe']);

        $caller->shouldHaveType('Indigo\Guardian\Caller\User\Simple');
    }

    function it_throws_an_exception_when_username_is_not_passed()
    {
        $this->shouldThrow('InvalidArgumentException')->duringIdentify([]);
    }

    function it_throws_an_exception_when_username_is_not_found()
    {
        $this->shouldThrow('InvalidArgumentException')->duringIdentify(['username' => 'jane_doe']);
    }
}
