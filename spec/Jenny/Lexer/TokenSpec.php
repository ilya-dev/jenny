<?php namespace spec\Jenny\Lexer;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

use Jenny\Lexer\Token;

class TokenSpec extends ObjectBehavior {

    function let()
    {
        $this->beConstructedWith('foo', Token::INDENTIFIER);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Jenny\Lexer\Token');
    }

    function it_returns_correct_type_and_value()
    {
        $this->getType()->shouldReturn(Token::INDENTIFIER);

        $this->getValue()->shouldReturn('foo');
    }

    function it_allows_you_to_compare_given_type_with_the_token_type()
    {
        $this->is(Token::NUMBER)->shouldBe(false);

        $this->is(Token::OPERATOR)->shouldBe(false);

        $this->is(Token::INDENTIFIER)->shouldBe(true);
    }

}

