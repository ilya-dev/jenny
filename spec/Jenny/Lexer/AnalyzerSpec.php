<?php namespace spec\Jenny\Lexer;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class AnalyzerSpec extends ObjectBehavior {

    function it_is_initializable()
    {
        $this->shouldHaveType('Jenny\Lexer\Analyzer');
    }

    function it_can_determine_a_white_space()
    {
        $this->isWhiteSpace('9')->shouldBe(false);
        $this->isWhiteSpace('a')->shouldBe(false);
        $this->isWhiteSpace('+')->shouldBe(false);

        $this->isWhiteSpace(' ')->shouldBe(true);
    }

    function it_can_determine_a_number()
    {
        $this->isNumber(' ')->shouldBe(false);
        $this->isNumber('a')->shouldBe(false);
        $this->isNumber('*')->shouldBe(false);

        $this->isNumber('.')->shouldBe(true);
        $this->isNumber('4')->shouldBe(true);
    }

    function it_can_determine_an_operator()
    {
        $this->isOperator(' ')->shouldBe(false);
        $this->isOperator('2')->shouldBe(false);
        $this->isOperator('.')->shouldBe(false);
        $this->isOperator('a')->shouldBe(false);

        $operators = ['/', '*', '+', '-', '%', '^', '(', ')', '='];

        foreach ($operators as $operator)
        {
            $this->isOperator($operator)->shouldBe(true);
        }
    }

    function it_can_determine_an_indentifier()
    {
        $this->isIndentifier(' ')->shouldBe(false);
        $this->isIndentifier('+')->shouldBe(false);
        $this->isIndentifier('7')->shouldBe(false);
        $this->isIndentifier('.')->shouldBe(false);

        $this->isIndentifier('a')->shouldBe(true);
        $this->isIndentifier('A')->shouldBe(true);
    }

}

