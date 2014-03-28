<?php namespace spec\Jenny\Lexer;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

use Jenny\Lexer\Token;
use Jenny\Lexer\Reader;
use Jenny\Lexer\Analyzer;

class TokenizerSpec extends ObjectBehavior {

    function let()
    {
        $this->beConstructedWith(new Reader, new Analyzer);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Jenny\Lexer\Tokenizer');
    }

    function it_throws_an_exception_if_an_invalid_input_was_provided()
    {
        $this->shouldThrow('Jenny\Lexer\Exceptions\UnrecognizedToken')
             ->duringTokenize('?');
    }

    function it_transforms_a_string_to_an_array_of_tokens()
    {
        $this->tokenize('46.5 + 2')->shouldBeLike($output = [

            new Token('46.5', Token::NUMBER),
            new Token('+', Token::OPERATOR),
            new Token('2', Token::NUMBER)

         ]);

        // white spaces should not affect the proccess of transforming
        $this->tokenize('46.5+2')->shouldBeLike($output);
    }

    function it_handles_indentifiers_and_assignments_as_well()
    {
        $this->tokenize('foo = 42 ^ bar')->shouldBeLike([

            new Token('foo', Token::INDENTIFIER),
            new Token('=', Token::OPERATOR),
            new Token('42', Token::NUMBER),
            new Token('^', Token::OPERATOR),
            new Token('bar', Token::INDENTIFIER)

        ]);
    }

    function it_allows_you_to_use_parentheses_for_grouping()
    {
        $this->tokenize('(2 * (6 ^ 2)) - 1')->shouldBeLike([

            new Token('(', Token::OPERATOR),
            new Token('2', Token::NUMBER),
            new Token('*', Token::OPERATOR),
            new Token('(', Token::OPERATOR),
            new Token('6', Token::NUMBER),
            new Token('^', Token::OPERATOR),
            new Token('2', Token::NUMBER),
            new Token(')', Token::OPERATOR),
            new Token(')', Token::OPERATOR),
            new Token('-', Token::OPERATOR),
            new Token('1', Token::NUMBER)

        ]);
    }

}

