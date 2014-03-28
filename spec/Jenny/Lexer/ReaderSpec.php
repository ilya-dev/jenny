<?php namespace spec\Jenny\Lexer;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ReaderSpec extends ObjectBehavior {

    function it_is_initializable()
    {
        $this->shouldHaveType('Jenny\Lexer\Reader');
    }

    function it_allows_you_to_set_the_input_string()
    {
        $this->setInput('abc');
    }

    function it_throws_an_exception_if_an_invalid_input_was_supplied()
    {
        $this->shouldThrow('InvalidArgumentException')->duringSetInput(null);
    }

    function it_returns_the_input_string()
    {
        $this->getInput()->shouldReturn('');

        $this->setInput('foo');

        $this->getInput()->shouldReturn('foo');
    }

    function it_advances_the_cursor_and_returns_the_corresponding_character()
    {
        $this->setInput('abc');

        $this->advance()->shouldBe('a');

        $this->advance()->shouldBe('b');

        $this->advance()->shouldBe('c');
    }

    function it_throws_an_exception_if_the_end_of_the_input_string_was_reached()
    {
        $this->setInput('a');

        $this->advance();

        $this->shouldThrow('Jenny\Lexer\Exceptions\EndOfLine')->duringAdvance();
    }

    function it_allows_you_to_determine_if_the_end_of_input_string_was_reached()
    {
        $this->setInput('a');

        $this->isEnd()->shouldBe(false);

        $this->advance();

        $this->isEnd()->shouldBe(true);
    }

}

