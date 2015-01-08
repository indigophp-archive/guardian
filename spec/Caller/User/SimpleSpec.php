<?php

namespace spec\Indigo\Guardian\Caller\User;

use PhpSpec\ObjectBehavior;

class SimpleSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(1, [
            'username' => 'john_doe',
            'password' => 'hashed_password',
            'name'     => 'John Doe',
        ]);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Indigo\Guardian\Caller\User\Simple');
    }

    function it_is_a_caller()
    {
        $this->shouldImplement('Indigo\Guardian\Caller\User');
    }

    function it_has_an_id()
    {
        $this->getId()->shouldReturn(1);
        $this->getCallerId()->shouldReturn(1);
    }

    function it_has_a_username()
    {
        $this->getUsername()->shouldReturn('john_doe');
    }

    function it_has_a_password()
    {
        $this->getPassword()->shouldReturn('hashed_password');
    }

    function it_can_have_dynamic_properties()
    {
        $this->getName()->shouldReturn('John Doe');
    }

    function it_throws_an_exception_when_property_name_is_not_found()
    {
        $this->shouldThrow('InvalidArgumentException')->duringGetUnknown();
    }

    function it_throws_an_exception_when_no_property_is_requested()
    {
        $this->shouldThrow('BadMethodCallException')->duringBadMethodCall();
    }

    function it_has_a_type()
    {
        $this->getCallerType()->shouldReturn('user');
    }

    function it_does_not_have_roles()
    {
        $this->getCallerRoles()->shouldReturn([]);
    }
}
