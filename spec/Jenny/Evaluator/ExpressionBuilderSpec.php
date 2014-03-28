<?php namespace spec\Jenny\Evaluator;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

use Jenny\Evaluator\Container;
use Jenny\Lexer\Token;

class ExpressionBuilderSpec extends ObjectBehavior {

    function let()
    {
        $container = new Container;

        $container->set('foo', 42);

        $this->beConstructedWith($container);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Jenny\Evaluator\ExpressionBuilder');
    }

    function it_allows_you_to_build_an_expression_from_the_given_array_of_tokens()
    {
        $tokens = [

            new Token('(', Token::OPERATOR),
            new Token('35', Token::NUMBER),
            new Token('+', Token::OPERATOR),
            new Token('foo', Token::INDENTIFIER),
            new Token(')', Token::OPERATOR),

        ];

        $this->build($tokens)->shouldReturn('(35+42)');
    }

}

