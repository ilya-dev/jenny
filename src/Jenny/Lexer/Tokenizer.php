<?php namespace Jenny\Lexer;

class Tokenizer {

    /**
     * The Reader instance
     *
     * @var \Jenny\Lexer\Reader
     */
    protected $reader;

    /**
     * The Analyzer instance
     *
     * @var \Jenny\Lexer\Analyzer
     */
    protected $analyzer;

    /**
     * The array of tokens
     *
     * @var array
     */
    protected $tokens = [];

    /**
     * The constructor
     *
     * @param  \Jenny\Lexer\Reader   $reader
     * @param  \Jenny\Lexer\Analyzer $analyzer
     * @return Tokenizer
     */
    public function __construct(Reader $reader, Analyzer $analyzer)
    {
        $this->reader   = $reader;
        $this->analyzer = $analyzer;
    }

    /**
     * Transform the given string to an array of tokens
     *
     * @param  string $string
     * @return array
     */
    public function tokenize($string)
    {
        $this->resetTokens();

        $this->reader->setInput($string);

        while ( ! $this->reader->isEnd())
        {
            $this->extractToken();
        }

        return $this->tokens;
    }

    /**
     * Reset the array of tokens
     *
     * @return void
     */
    protected function resetTokens()
    {
        $this->tokens = [];
    }

    /**
     * Extract exactly one token from the input string
     *
     * @param  string|null $character
     * @return void
     */
    protected function extractToken($character = null)
    {
        $character = $character ?: $this->reader->advance();
        $analyzer  = $this->analyzer;

        if ($analyzer->isWhiteSpace($character))
        {
            // all white spaces are ignored completely

            return;
        }

        if ($analyzer->isOperator($character))
        {
            $this->addOperator($character);

            return;
        }

        if ($analyzer->isIndentifier($character))
        {
            $this->extractIndentifier($character);

            return;
        }

        if ($analyzer->isNumber($character))
        {
            $this->extractNumber($character);

            return;
        }

        throw new Exceptions\UnrecognizedToken(
            "No corresponding token for $character"
        );
    }

    /**
     * Extract a number from the input string
     *
     * @param  string $number
     * @return string
     */
    protected function extractNumber($number)
    {
        list($reader, $analyzer) = [$this->reader, $this->analyzer];

        try
        {
            while($analyzer->isNumber($character = $reader->advance()))
            {
                $number .= $character;
            }
        }

        catch (Exceptions\EndOfLine $e)
        {
            $this->addNumber($number);

            return;
        }

        $this->addNumber($number);

        $this->extractToken($character);
    }

    /**
     * Extract an indentifier from the input string
     *
     * @param  string $indentifier
     * @return string
     */
    protected function extractIndentifier($indentifier)
    {
        list($reader, $analyzer) = [$this->reader, $this->analyzer];

        try
        {
            while ($analyzer->isIndentifier($character = $reader->advance()))
            {
                $indentifier .= $character;
            }
        }

        catch (Exceptions\EndOfLine $e)
        {
            $this->addIndentifier($indentifier);

            return;
        }

        $this->addIndentifier($indentifier);

        $this->extractToken($character);
    }

    /**
     * Add a token of type "indentifier"
     *
     * @param  string $indentifier
     * @return void
     */
    protected function addIndentifier($indentifier)
    {
        $this->addToken($indentifier, Token::INDENTIFIER);
    }

    /**
     * Add a token of type "number"
     *
     * @param  string $number
     * @return void
     */
    protected function addNumber($number)
    {
        $this->addToken($number, Token::NUMBER);
    }

    /**
     * Add a token of type "operator"
     *
     * @param  string $operator
     * @return void
     */
    protected function addOperator($operator)
    {
        $this->addToken($operator, Token::OPERATOR);
    }

    /**
     * Add a new token to the tokens array
     *
     * @param  mixed  $value
     * @param  string $type
     * @return void
     */
    protected function addToken($value, $type)
    {
        $this->tokens[] = new Token($value, $type);
    }

}

