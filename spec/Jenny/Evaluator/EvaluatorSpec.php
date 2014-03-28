<?php namespace spec\Jenny\Evaluator;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

use Jenny\Evaluator\Container;
use Jenny\Evaluator\ExpressionBuilder as Builder;

use Jenny\Lexer\Token;

class EvaluatorSpec extends ObjectBehavior {

    function let()
    {
        $container = new Container;

        $this->beConstructedWith($container, new Builder($container));
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Jenny\Evaluator\Evaluator');
    }

    function it_makes_the_given_expression_compatible_with_the_php_syntax()
    {
        $this->makeCompatible('12.58^-13')->shouldReturn('pow(12.58,-13)');

        $this->makeCompatible('-245.526^51')->shouldReturn('pow(-245.526,51)');
    }

    function it_evaluates_the_given_array_of_tokens()
    {
        $tokens = [

            new Token('bar', Token::INDENTIFIER),
            new Token('=', Token::OPERATOR),
            new Token(42, Token::NUMBER),

         ];

        $this->evaluateLine($tokens)->shouldBe("[bar] equals to 42");

        $tokens = [

            new Token('bar', Token::INDENTIFIER),
            new Token('-', Token::OPERATOR),
            new Token(22, Token::NUMBER),

        ];

        $this->evaluateLine($tokens)->shouldBe(20);
    }

}

