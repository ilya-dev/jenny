<?php namespace spec\Jenny\Evaluator;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ContainerSpec extends ObjectBehavior {

    function it_is_initializable()
    {
        $this->shouldHaveType('Jenny\Evaluator\Container');
    }

    function it_returns_null_if_the_given_key_does_not_exist()
    {
        $randomKey = strval(rand());

        $this->get($randomKey)->shouldReturn(null);
    }

    function it_provides_e_and_pi_constants()
    {
        $this->get('e')->shouldBe(M_E);

        $this->get('pi')->shouldBe(M_PI);
    }

    function it_allows_you_to_add_a_key_value_pair_to_the_container()
    {
        $this->set('foo', 'bar');

        $this->get('foo')->shouldReturn('bar');
    }

}

